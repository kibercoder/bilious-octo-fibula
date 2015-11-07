<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ServiceType $model
 */
$this->title = Yii::t('app', 'Create Service Type');
$this->params['breadcrumbs'][] = ['label' => 'Service Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-type-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
