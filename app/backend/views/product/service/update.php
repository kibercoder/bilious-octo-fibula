<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Service $model
 */

$this->title = Yii::t('app', 'Update Service') . ': ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="service-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
