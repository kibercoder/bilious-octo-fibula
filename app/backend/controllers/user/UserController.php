<?php

namespace backend\controllers\user;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Model;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public $roles;

    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    ['actions' => ['updatestatus','index','create','update','activateusers','delete','multydelete','clearchache'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'multydelete' => ['post'],

                ],
            ],
        ];
    }

    /**
     * Batch update
     */
    public function actionBatchUpdate()
    {
        $sourceModel = new UserSearch();
        $dataProvider = $sourceModel->search(Yii::$app->request->getQueryParams());
        $models = $dataProvider->getModels();

        if ( Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models) ) {

            $count = 0;

            foreach ($models as $index => $model) {
                // populate and save records for each model
                if ($model->save()) {
                    $count++;
                }
            }

            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['index']); // redirect to your next desired page

        } else {
            return $this->render('update', [
                'model'=>$sourceModel,
                'dataProvider'=>$dataProvider
            ]);
        }
    }

    public function actionUpdatestatus($id, $state){

        // себя заблокировать не можем
        if( $id == Yii::$app->user->id ){
            return false;
        }

        $model = User::findOne(['id' => $id]);
        $model->status = $state ? User::STATUS_ACTIVE : User::STATUS_DELETED;
        $model->save();
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
     /*
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }*/

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'id' => $model->id];

            return $this->redirect($redirect);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'id' => $model->id];

            return $this->redirect($redirect);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }




    public function actionManage($param=''){

        $pk = Yii::$app->request->post('pk');

        $model = $this->actionActivateusers($pk);

        if (Yii::$app->request->isPjax && $model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new YourModel(); //reset model
        }
        $model->paramId = $param;
        $queryParams = Yii::$app->request->getQueryParams();
        $queryParams['YourModelSearch']['param'] = $param;
        $searchModel = new YourModelSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }




    /**
     * Bulk Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionActivateusers($param='')
    {

        $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys

        // Preventing extra unnecessary query
        if (!$pk) {
            //return $this->redirect(['index']);
        }

        foreach($pk as $k => $v) {
          if (is_numeric($v)) $this->actionUpdatestatus($v,10);
        }

        /*$searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->renderAjax('activateusers', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);*/

        //return $this->redirect(['index']);

    }


    /**
   * Bulk Deletes an existing User model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
    public function actionMultydelete()
    {
        $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys

        // Preventing extra unnecessary query
        if (!$pk) {
            return $this->redirect(['index']);
        }

        foreach($pk as $k => $v) {
          if (is_numeric($v)) $this->actionUpdatestatus($v,0);
        }

        /*foreach($pk as $k => $v) {
          if (is_numeric($v)) $this->findModel($v)->delete();
        }*/

        //return $this->redirect(['index']);
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
