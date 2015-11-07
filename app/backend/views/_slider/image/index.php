<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\SliderImageSearch $searchModel
 */

$this->title = Yii::t('app', 'Slider Images');
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>
<div class="slider-image-index">
    <!--
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Slider Image',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'publish_flag',
                'class'=>'kartik\grid\BooleanColumn',
                'vAlign'=>'middle',
            ],
            'href',
            'slider',
            ['attribute'=>'created_date','format'=>['date']],
                        [
                'attribute'=>'banner_image',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img( $model->getUploadUrl('banner_image'), ['width'=>'100']);
                },
            ],
                        [
                'attribute'=>'banner_phone_image',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img( $model->getUploadUrl('banner_phone_image'), ['width'=>'100']);
                },
            ],
                        [
                'attribute'=>'banner_tablet_image',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img( $model->getUploadUrl('banner_tablet_image'), ['width'=>'100']);
                },
            ],
                        [
                'attribute'=>'menu_image',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img( $model->getUploadUrl('menu_image'), ['width'=>'100']);
                },
            ],
            [
                'attribute'=>'href_enabled_flag',
                'class'=>'kartik\grid\BooleanColumn',
                'vAlign'=>'middle',
            ],
            'iframe_href',

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
