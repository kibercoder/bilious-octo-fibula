<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SliderImage $model
 */
$this->title = Yii::t('app', 'Create Slider Image');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slider Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
