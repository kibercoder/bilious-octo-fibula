<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\PostSearch $searchModel
 */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC] ]);

?>

<div class="post-index">
    <!--
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Post',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'user_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !property_exists($model,"user")){
                        return null;
                    }

                    $url = Url::to(['user/update','id' =>$model->user->id]);

                    return Html::a($model->user->username, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],
            [
                'attribute' => 'category_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !property_exists($model,"category")){
                        return null;
                    }

                    $url = Url::to(['category/update','id' =>$model->category->id]);

                    return Html::a($model->category->title, '#', [
                        'title'=>'View detail',
                        'onclick' => 'window.location = "'.$url.'"',
                    ]);
                },
            ],
            [
                'attribute' => 'state_index',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    return $model->getStateIndexList(intval($model->state_index));
                },
            ],
            [
                'attribute'=>'main_flag',
                'class'=>'kartik\grid\BooleanColumn',
                'vAlign'=>'middle',
            ],
            ['attribute'=>'created_datetime','format'=>['datetime']],
            ['attribute'=>'start_time','format'=>['time']],
            ['attribute'=>'start_date','format'=>['date']],
                        [
                'attribute'=>'preview_image',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img( $model->preview_image, ['width'=>'100']);
                },
            ],
            //['attribute'=>'created_date','format'=>['date']],
            [
                'attribute' => 'noforeign_id',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) {

                    if( !property_exists($model,"noforeign")){
                        return null;
                    }

                    $url = Url::to(['noforeign/update','id' =>$model->noforeign->id]);

                    return Html::a($model->noforeign->title, '#', [
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
                                                  ]);
                    }

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
