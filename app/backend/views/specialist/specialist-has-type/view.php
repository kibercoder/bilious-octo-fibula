<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\SpecialistHasType $model
 */

$this->title = $model->spec_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialist Has Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialist-has-type-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'spec_id',
            'spec_type_id',
        ],
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->spec_id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>true,
    ]) ?>

</div>
