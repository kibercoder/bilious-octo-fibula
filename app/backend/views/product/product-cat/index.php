<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\ProductCatSearch $searchModel
 */

$this->title = Yii::t('app', 'Product Cats');
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>
<div class="product-cat-index">
    <!--
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Product Cat',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php /*Pjax::begin();*/ echo GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'options' => [
                'id' => 'w2',
            ],
         ],
        /*'filterModel' => $searchModel,*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
            'id',
            'title',
            [
                'attribute' => 'parent_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !$model->parent_id ){
                        return null;
                    }

                    if( !method_exists($model,"getParent") ||
                        strlen($model->parent->title)<=0 ||
                        !is_numeric($model->parent->id)){
                        return null;
                    }

                    $url = Url::to(['parent/parent/update','id' =>$model->parent->id]);

                    return Html::a($model->parent->title, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],
            
            [
                'attribute' => 'menu_flag',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->getMenuIndexList($model->menu_flag);
                },
            ],
            
            'list_order',

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

        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']),

            'after'=>Html::button('<i class="glyphicon glyphicon-remove"></i> ' .Yii::t('app', 'Multydelete'),['class' => 'btn btn-danger kv-batch-delete', 'onclick' => '(function ( $event ) { if (confirm("Выбранные записи будут удалены без возможности восстановления. Удалить выбранные записи?")) {

        var $grid = $("#w2");
        var selectedList = $grid.yiiGridView("getSelectedRows");

        if( selectedList.length == 0 ){
            return false;
        }

        $.post("multydelete", { pk: selectedList }, function (data) {
            $grid.yiiGridView("applyFilter");
        });

      }})(); return false']),


            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '. Yii::t('app', 'Reset list'), ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); /*Pjax::end();*/ ?>

</div>
