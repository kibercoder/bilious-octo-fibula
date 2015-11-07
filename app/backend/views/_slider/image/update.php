<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SliderImage $model
 */

$this->title = Yii::t('app', 'Update Slider Image') . ': ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slider Images'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="slider-image-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
