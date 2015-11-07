<?php
namespace frontend\controllers\product;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use common\models\Product;
use common\models\ProductType;
use common\models\ProductCat;
use common\models\Organization;
use common\models\Agreement;
use frontend\models\ProfileForm;
use frontend\models\OrderForm;
use common\models\Specialist;
use common\models\Diagnos;


class DefaultController extends Controller
{
    /**
   * @inheritdoc
   */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'cat', 'search', 'product', 'product-buy'],
                        'allow' => true,
                        //'roles' => ['@']
                    ],
                ],
            ],

        ];
    }

    public function beforeAction($action) {
        Yii::$app->controller->enableCsrfValidation = ($action->id !== "product-buy");
        return parent::beforeAction($action);
    }


   /**
   * @inheritdoc
   */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Страница категории
     */
    public function actionCat($id)
    {
        $query = Product::find()
            ->joinWith('type')
            ->where([ ProductType::TableName() . '.cat_id' => $id]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);

        $productList = $query
            //->orderBy($sort->orders)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->with(['type'])
            ->with(['organization'])
            ->asArray()
            ->all();

        Product::format($productList);

        $randProduct = Product::getRandom(1);
        $randOrg = Organization::getRandom(1);
        $randSpec = Specialist::getRandom(1, [], ['specTypes']);

        return $this->render('cat', [
            'item' => ProductCat::find()->where(['id' => $id])->asArray()->one(),
            'productList' => $productList,
            'productPages' => $pages,
            'randProduct' => $randProduct,
            'randOrg' => $randOrg,
            'randSpec' => $randSpec,
        ]);
    }

    /**
     * Страница продукта
     */
    public function actionProduct($id){

        $item = Product::find()
          ->with('organization', 'type')
          ->where(['id' => $id])
          ->asArray()->one();

        $recommend = Product::find()
          ->with('organization', 'type')
          ->where(['type_id' => $item['type_id']])->limit(2)
          ->asArray()->all();

        Product::format($recommend);

        return $this->render('product', [
            'item' => $item,
            'recommend' => $recommend
        ]);
    }

    /**
     * Страница продукта
     */
    public function actionProductBuy($id){

        $item = Product::find()
          ->with('organization', 'type')
          ->with('agreement')
          ->where(['id' => $id])
          ->asArray()->one();

        $item['price_format'] = Product::priceFormat($item['price']);
        $item['price_discount_format'] = Product::priceFormat($item['price_discount']);

        if (!count($item['agreement'])) {
            $agreement = Agreement::find()->where(["default_flag" => 1])->asArray()->one();
            $item['agreement'] = $agreement;
        }

        // Загружаем в форму данные пользователя
        $user = Yii::$app->user->getIdentity();
        $model_signup = array();
        $page = $user ? 'product_buy' : 'buy_forbidden';

        if ($page == 'buy_forbidden') {

            $model_signup = new ProfileForm();
            $model_signup->setScenario('signup');

            if ($model_signup->load(Yii::$app->request->post())) {

                if ($user = $model_signup->signup()) {

                    if (Yii::$app->getUser()->login($user)) {
                        return $this->redirect(Yii::$app->request->referrer);
                        //return $this->goHome();
                    }
                }
            }

        } else {

            if (Yii::$app->request->post() && $user) {

                // Устанавливаем сценарий валидации
                $form = new OrderForm();

                if ($form->saveOrder($user,$item, Yii::$app->request->post())) die('true');
                else die('false');

            }

        }

        return $this->render($page, [
            'item' => $item,
            'user' => $user,
            'model_signup' => $model_signup,
        ]);
    }

    /**
     * Страница поиска
     */
    public function actionSearch(){

        $this->showSearchBlock = true;
        $this->openAdvSearchBlock = true;

        $searchQuery = Yii::$app->request->get('q');

        $searchQueryPrice_min = (int)Yii::$app->request->get('price_min');

        $searchQueryPrice_max = (int)Yii::$app->request->get('price_max');

        $searchQueryCat = (int)Yii::$app->request->get('cat');

        $searchQueryOrg = (array)Yii::$app->request->get('org');

        $searchQuerySpec = (int)Yii::$app->request->get('spec');

        $searchQuerySpecType = (int)Yii::$app->request->get('spec_type');
        
        $searchQueryDiagnos = (int)Yii::$app->request->get('diagnos');

        $query = Product::find()->joinWith(['type',]);

        // Поисковой запрос
        if( $searchQuery ){
            $query->where(['like', 'keywords', $searchQuery]);
        } else {
            $query->where([]);
        }

        if ($searchQuerySpecType) {

          $query->joinWith(['specType'])
          ->andFilterWhere([
              'tbl_specialist_has_type.spec_type_id' => $searchQuerySpecType,
              'tbl_specialist_type.id' => $searchQuerySpecType
          ]);

        }
        
        if ($searchQueryDiagnos) {

          $query->joinWith(['diagnos'])
          ->andFilterWhere([
              'tbl_product_type_has_diagnos.diagnos_id' => $searchQueryDiagnos,
              'tbl_diagnos.id' => $searchQueryDiagnos
          ]);

        }
        
        //если указана цена
        if ($searchQueryPrice_min>0 && $searchQueryPrice_max>0) {
          $query->andFilterWhere([
                    ">", 'price_discount', $searchQueryPrice_min
          ]);
          $query->andFilterWhere([
                    "<", 'price_discount', $searchQueryPrice_max
          ]);

        }
        //если указана категория или тип заболевания
        if ($searchQueryCat > 0) {
          $query->andFilterWhere(['cat_id' => $searchQueryCat]);
        }
        
        //Если указаны организации
        if (count($searchQueryOrg)>0) {
          $query->andFilterWhere(['in','organization_id', $searchQueryOrg]);
        }
        //если указан специалист
        if ($searchQuerySpec) {
          $query->andFilterWhere(['specialist_id' => $searchQuerySpec]);
        }

        //http://ihealthdev.upmc.ru/search?q=%D0%BB%D0%B5%D1%87%D0%B5%D0%BD%D0%B8%D0%B5&price_min=1000&price_max=200000&cat=21&org=7&spec_type=2&spec=2
        //echo $query->createCommand()->getRawSql();
        //die;

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);

        $_productList = $query
            //->orderBy($sort->orders)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->with(['type', 'organization', 'specialist'])
            ->asArray()
            ->all();

        //Получаем новые поля price_format и price_discount_format в виде number_format
        Product::format($_productList);

        //Заболевания диагноз parent_id > 0
        //$catList = ArrayHelper::index( ProductCat::find()->where(['>','parent_id',0])->asArray()->all(), 'id' );

        //Список организаций
        //$orgList = ArrayHelper::index(Organization::find()->asArray()->all(), 'id');

        //Список специалистов
        //$specList = ArrayHelper::index(Specialist::find()->asArray()->all(), 'id');

        $productList = [
            'diagnost' => [
                'title' => 'Диагностика',
                'desc' => 'Уточните свой диагноз и проблемную область',
                'list' => [],
            ],
            'program' => [
                'title' => 'Программы лечения',
                'desc' => 'Посмотрите программы лечения и выберите свой курс лечения',
                'list' => [],
            ],
            'spec' => [
                'title' => 'Специалисты',
                'desc' => 'Проконсультируйтесь с ведущими специлистами',
                'list' => [],
            ],
        ];

        foreach($_productList as $item){
            if( $item['type'] ){

                if( $item['specialist_id'] > 0 ){
                    $productList['spec']['list'][$item['id']] = $item;
                } elseif ($item['type']['type_index'] == 1) {
                    $productList['diagnost']['list'][$item['id']] = $item;
                } elseif ($item['type']['type_index'] == 2) {
                    $productList['program']['list'][$item['id']] = $item;
                }
            }
        }

        /*print '<pre>';
        echo count($productList['spec']['list']);
        print_r ($productList['spec']['list']);
        print '</pre>';
        die;*/


        // RightBlock data
        $typeIds = ArrayHelper::getColumn($_productList, 'type_id');

        $blockData['productList'] = Product::LoadList('*', 'priority > 0', 'priority desc', 3);
        $blockData['orgList'] = Organization::LoadList('*', 'priority > 0', 'priority desc', 2);

        return $this->render('search', [
            'query' => $searchQuery,
            'productList' => $productList,
            'productPages' => $pages,
            'blockData' => $blockData,
        ]);

    }




}

?>
