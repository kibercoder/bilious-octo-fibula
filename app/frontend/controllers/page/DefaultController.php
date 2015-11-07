<?php
namespace frontend\controllers\page;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\models\Organization;
use common\models\Product;
use common\models\Specialist;
use common\models\SpecialistType;
use common\models\Recommend;
use yii\helpers\ArrayHelper;


/**
 * Site controller
 */
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
                        'actions' => ['index', 'about', 'how', 'newpage', 'error', 'organizations', 'specialists', 'specialist'],
                        'allow' => true,
                        //'roles' => ['moderator']
                    ],
                ],
            ]
        ];
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
     * Главная страница
     */
    public function actionIndex()
    {
        $this->showSearchBlock = true;
        
        return $this->render('index',[
            'review_list' => Recommend::find()->select('*')->orderBy('list_order DESC')->asArray()->all(),
            'orgList' => Organization::loadList('*', 'priority > 0', 'priority desc'),
            'productList' => Product::loadList('*', 'priority > 0', 'priority desc'),
            'specList' => Specialist::loadList(),
        ]);
    }

    public function actionAbout()
    {

        return $this->render('about', [
            'orgList' => Organization::loadList(),
            'productList' => Product::loadList(),
            'specList' => Specialist::loadList(),
        ]);
    }

/*
    public function actionTo_diagnose()
    {
        return $this->render('to_diagnose');
    }

    public function actionTo_checkup(){
        return $this->render('to_checkup');
    }

    public function actionTo_calculate(){
        return $this->render('to_calculate');
    }

    public function actionSearch_diagnosis(){
        return $this->render('search_diagnosis');
    }

    public function actionSearch_clinics(){
        return $this->render('search_clinics');
    }

    public function actionSearch_places(){

        $query = Organization::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>5,'pageSize'=>5]);

        $allOrganization = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $query = Organization::find()->where("title != 'null'")->orderBy('id DESC');

        if (strlen(Yii::$app->request->get('search'))>=3) {
          $search = Yii::$app->request->get()['search'];
          $query->andFilterWhere(['LIKE' ,'title',$search])->orFilterWhere(['LIKE', 'body', $search]);
        }

        $mainOrganization = $query->offset(0)
            ->limit(5)
            ->all();

        return $this->render('search_places', [
            'all_organization' => $allOrganization,
            'main_organization' => $mainOrganization,
            'pages' => $pages
        ]);
    }
*/


    /**
     * Список специалистов
     */
    public function actionSpecialists(){
        return $this->render('specialists', [

        ]);
    }

    /**
     * Страница специалиста
     */
    public function actionSpecialist($id){
        return $this->render('specialist', [
            'item' => Specialist::find()->where(['id'=>$id])->asArray()->one()
        ]);
    }

    public function actionHow(){
        return $this->render('how');
    }





}
