<?php

namespace backend\controllers\specialist;

use Yii;
use common\models\SpecialistHasType;
use common\models\SpecialistHasTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SpecialistHasTypeController implements the CRUD actions for SpecialistHasType model.
 */
class SpecialistHasTypeController extends Controller
{
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    ['actions' => ['multydelete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SpecialistHasType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialistHasTypeSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single SpecialistHasType model.
     * @param integer $spec_id
     * @param integer $spec_type_id
     * @return mixed
     */
     /*
    public function actionView($spec_id, $spec_type_id)
    {
        $model = $this->findModel($spec_id, $spec_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->spec_id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }*/

    /**
     * Creates a new SpecialistHasType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SpecialistHasType;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'spec_id' => $model->spec_id, 'spec_type_id' => $model->spec_type_id];

            return $this->redirect($redirect);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing SpecialistHasType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $spec_id
     * @param integer $spec_type_id
     * @return mixed
     */
    public function actionUpdate($spec_id, $spec_type_id)
    {
        $model = $this->findModel($spec_id, $spec_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'spec_id' => $model->spec_id, 'spec_type_id' => $model->spec_type_id];

            return $this->redirect($redirect);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SpecialistHasType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $spec_id
     * @param integer $spec_type_id
     * @return mixed
     */
    public function actionDelete($spec_id, $spec_type_id)
    {
        $this->findModel($spec_id, $spec_type_id)->delete();

        return $this->redirect(['index']);
    }
    
    
    /**
     * Bulk Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionMultydelete($param='')
    {
        $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys
        
        // Preventing extra unnecessary query
        if (!$pk) {
          return $this->redirect(['index']);
        }

        foreach($pk as $k => $v) {
          if (is_numeric($v)) $this->findModel($v)->delete();
        }

        //return $this->redirect(['index']);
    }

    
    

    /**
     * Finds the SpecialistHasType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $spec_id
     * @param integer $spec_type_id
     * @return SpecialistHasType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($spec_id, $spec_type_id)
    {
        if (($model = SpecialistHasType::findOne(['spec_id' => $spec_id, 'spec_type_id' => $spec_type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
