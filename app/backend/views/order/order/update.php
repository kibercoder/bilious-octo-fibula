<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Order $model
 */

$this->title = Yii::t('app', 'Update Order') . ': ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
