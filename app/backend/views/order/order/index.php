<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\OrderSearch $searchModel
 */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>
<div class="order-index">
    <!--
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Order',
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
            [
                'attribute' => 'user_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !$model->user_id ){
                        return null;
                    }

                    if( !method_exists($model,"getUser") ||
                        strlen($model->user->username)<=0 ||
                        !is_numeric($model->user->id)){
                        return null;
                    }

                    $url = Url::to(['user/user/update','id' =>$model->user->id]);

                    return Html::a($model->user->username, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],
            'summ',
            [
                'attribute' => 'status_index',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    return $model->getStatusIndexList(intval($model->status_index));
                },
            ],
            ['attribute'=>'created_datetime','format'=>['datetime']],
            ['attribute'=>'finished_datetime','format'=>['datetime']],

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
