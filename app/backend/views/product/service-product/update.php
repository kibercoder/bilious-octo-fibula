<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ServiceProduct $model
 */

$this->title = Yii::t('app', 'Update Service Product') . ': ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => 'Service Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="service-product-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
