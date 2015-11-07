<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ServiceProduct $model
 */
$this->title = Yii::t('app', 'Create Service Product');
$this->params['breadcrumbs'][] = ['label' => 'Service Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-product-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
