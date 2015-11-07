<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\ServiceProductSearch $searchModel
 */

$this->title = 'Service Products';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>
<div class="service-product-index">
    <!--
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Service Product', ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !method_exists($model,"getproduct")){
                        return null;
                    }

                    $url = Url::to(['product/update','id' =>$model->product->id]);

                    return Html::a($model->product->title, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],
            [
                'attribute' => 'service_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !method_exists($model,"getservice")){
                        return null;
                    }

                    $url = Url::to(['service/update','id' =>$model->service->id]);

                    return Html::a($model->service->title, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                'view' => function($url, $model){
                    return null;
                },
                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update','id' => $model->id], [
                                                    'title' => Yii::t('app', 'Edit'),
                                                  ]);}

                ],

                'contentOptions'=>['style'=>'min-width: 45px'],
            ],

            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],

        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '. Yii::t('app', 'Reset list'), ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>
