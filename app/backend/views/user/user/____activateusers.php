<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use kartik\widgets\SwitchInput;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\UserSearch $searchModel
 */

?>

    <?php Pjax::begin(); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
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
            /*[
              'attribute' => 'status',
              //'type'=>TabularForm::INPUT_WIDGET,
              'format' => 'raw',
              'vAlign' => GridView::ALIGN_MIDDLE,
              'value' => function($model){

                  $widget = SwitchInput::widget([
                      'name' => 'status',
                      'type' => SwitchInput::CHECKBOX,
                      'value' => $model->status,
                      'disabled' => $model->id == Yii::$app->user->id,
                      'pluginOptions' => ['size' => 'middle'],
                      'pluginEvents' => [
                          "switchChange.bootstrapSwitch" => "function(e, state) {
                              $.post('".  Url::toRoute(['updatestatus'])  ."' + '?id=".$model->id."&state=' + (state?1:0));
                          }",
                      ],
                  ]);

                  return $widget;
              }
            ],*/
            'created_at:datetime',
            //'updated_at:datetime',
            'phone',
            //'mobile_phone',

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
                     
                     
                                                         
            'after'=>Html::button('<i class="glyphicon glyphicon-ok"></i> ' .Yii::t('app', 'ActivateUsers'),['class' => 'btn btn-info', 'onclick' => '(function ( $event ) {
  $.post(
      "activateusers", 
      {
          pk : $("#w3").yiiGridView("getSelectedRows")
      },
      function (data) {
          alert(data);
        
          $.pjax.reload({container:"#w3"});
          return false;
      });
      return false;
})();']).'&nbsp;&nbsp;&nbsp;'.
      
      Html::button('<i class="glyphicon glyphicon-remove"></i> ' .Yii::t('app', 'Multydelete'),['class' => 'btn btn-danger kv-batch-delete', 'onclick' => '(function ( $event ) { if (confirm("Заблокировать выбранных пользователей?")) {
        $.post(
            "multydelete", 
            {
                pk : $("#w3").yiiGridView("getSelectedRows")
            },
            function (data) {
                $.pjax.reload({container:"#w3"});
                //return false;
            });
        //return false;
      }})();']),  


            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '. Yii::t('app', 'Reset list'), ['index'], ['class' => 'btn btn-info']),
            
            'showFooter'=>false,
            //'after'=> Html::button('<i class="glyphicon glyphicon-remove"></i> ', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete'])

        ],
    ]); 
    
    Pjax::end(); ?>