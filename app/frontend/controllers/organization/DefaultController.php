<?php
namespace frontend\controllers\organization;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\data\Pagination;
use yii\widgets\LinkPager;

use common\models\Organization;
use common\models\OrganizationSearch;
use common\models\Product;

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
                        'actions' => ['index', 'organization', 'organizations'],
                        'allow' => true,
                        //'roles' => ['@']
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

/*
    public function actionSearch_clinics($page = 1){

        $query = Organization::find()->where("title != 'null'")->orderBy('id DESC');

        $search = 'Поиск клиник';

        if (strlen(Yii::$app->request->get('search'))>=3) {
          $search = Yii::$app->request->get('search');
          $query->andFilterWhere(['LIKE' ,'title',$search])->orFilterWhere(['LIKE', 'body', $search]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>2,'pageSize'=>2]);

        $allOrganization = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $query = Organization::find()->where("title != 'null'")->orderBy('id DESC');

        if (strlen(Yii::$app->request->get('search'))>=3) {
          $search = Yii::$app->request->get('search');
          $query->andFilterWhere(['LIKE' ,'title',$search])->orFilterWhere(['LIKE', 'body', $search]);
        }

        $offset = 0;
        if (Yii::$app->request->get('page')>=2) {
           $page = (int)(int)Yii::$app->request->get('page')-1;
           $offset = (int)$pages->limit * $page;
        }

        $mainOrganization = $query->offset($offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search_clinics', [
            'all_organization' => $allOrganization,
            'main_organization' => $mainOrganization,
            'pages' => $pages,
            'search' => $search,
        ]);
    }
*/

    public function actionOrganization($id)
    {
        // Все кроме текущей
        $orgList = Organization::loadList('*', "id != {$id}");

        // Продукты организации
        $productList = Product::loadList('*', ['organization_id' => $id]);

        $model = $this->findModel($id);

        return $this->render('organization',[
            'model'=>$model,
            'orgList' => $orgList,
            'productList' => $productList,
        ]);
    }

    /**
     * Лучшие оргнизации
     */
    public function actionOrganizations(){
        return $this->render('organizations', [
            'orgList' => Organization::loadList()
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}

?>
