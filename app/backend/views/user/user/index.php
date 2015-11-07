<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\UserSearch $searchModel
 */

$this->title = Yii::t('app', 'Пользователи');
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>
<div class="user-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p></p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'options' => [
                'id' => 'w2',
            ],
         ],

        'columns' => [
            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],

            'id',
            'last_name',
            'first_name',
            'middle_name',
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'format'=>'raw',
                'value'=>function($searchModel, $key, $index, $widget){
                  $roles = $searchModel->getRoles();
                  $k = (int)$searchModel->role;

                  return $roles[$k];
                },
            ],
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value'=>function($searchModel, $key, $index, $widget){
                  $statuses = $searchModel->getStatuses();
                  $k = (int)$searchModel->status;

                  return $statuses[$k];
                },
            ],
            'created_at:datetime',
            'phone',
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

            'after'=>Html::button('<i class="glyphicon glyphicon-ok"></i> ' .Yii::t('app', 'ActivateUsers'),['class' => 'btn btn-info', 'onclick' => '(function () {

  var $grid = $("#w2");
  var selectedList = $grid.yiiGridView("getSelectedRows");

  if( selectedList.length == 0 ){
      return false;
  }

  $.post(
      "activateusers", { pk: selectedList },
      function (data) {
          $.pjax.reload({container: "#" + $grid.attr("id") });;
      });
})(); return false;']).'&nbsp;&nbsp;&nbsp;'.

      Html::button('<i class="glyphicon glyphicon-remove"></i> ' .Yii::t('app', 'Multydelete'),['class' => 'btn btn-danger kv-batch-delete', 'onclick' => '(function () {

        var $grid = $("#w2");
        var selectedList = $grid.yiiGridView("getSelectedRows");

        if( selectedList.length == 0 ){
            return false;
        }

        $.post(
            "multydelete", { pk: selectedList },
            function (data) {
                $grid.yiiGridView("applyFilter");
            }
        );
      })(); return false']),


            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '. Yii::t('app', 'Reset list'), ['index'], ['class' => 'btn btn-info']),

            'showFooter'=>false,
            //'after'=> Html::button('<i class="glyphicon glyphicon-remove"></i> ', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete'])

        ],
    ]);

    ?>


</div>
