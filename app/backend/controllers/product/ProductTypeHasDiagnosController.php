<?php

namespace backend\controllers\product;

use Yii;
use common\models\ProductTypeHasDiagnos;
use common\models\ProductTypeHasDiagnosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProductTypeHasDiagnosController implements the CRUD actions for ProductTypeHasDiagnos model.
 */
class ProductTypeHasDiagnosController extends Controller
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
     * Lists all ProductTypeHasDiagnos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductTypeHasDiagnosSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single ProductTypeHasDiagnos model.
     * @param integer $diagnos_id
     * @param integer $product_type_id
     * @return mixed
     */
     /*
    public function actionView($diagnos_id, $product_type_id)
    {
        $model = $this->findModel($diagnos_id, $product_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->diagnos_id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }*/

    /**
     * Creates a new ProductTypeHasDiagnos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductTypeHasDiagnos;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'diagnos_id' => $model->diagnos_id, 'product_type_id' => $model->product_type_id];

            return $this->redirect($redirect);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing ProductTypeHasDiagnos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $diagnos_id
     * @param integer $product_type_id
     * @return mixed
     */
    public function actionUpdate($diagnos_id, $product_type_id)
    {
        $model = $this->findModel($diagnos_id, $product_type_id);
        
        foreach((array)$model->attributes as $field=>$v) {
            if (substr($field, -5, 5) == '_file' || substr($field, -6, 6) == '_image'){
                $model->$field = (file_exists($_SERVER['DOCUMENT_ROOT'].$model->$field)) ? $model->$field : null;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $redirect = yii::$app->request->post('goto') == 'list'
                ? ['index']
                : ['update', 'diagnos_id' => $model->diagnos_id, 'product_type_id' => $model->product_type_id];

            return $this->redirect($redirect);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductTypeHasDiagnos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $diagnos_id
     * @param integer $product_type_id
     * @return mixed
     */
    public function actionDelete($diagnos_id, $product_type_id)
    {
        $this->findModel($diagnos_id, $product_type_id)->delete();

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
     * Finds the ProductTypeHasDiagnos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $diagnos_id
     * @param integer $product_type_id
     * @return ProductTypeHasDiagnos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($diagnos_id, $product_type_id)
    {
        if (($model = ProductTypeHasDiagnos::findOne(['diagnos_id' => $diagnos_id, 'product_type_id' => $product_type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
