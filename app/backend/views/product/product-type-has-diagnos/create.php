<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ProductTypeHasDiagnos $model
 */
$this->title = Yii::t('app', 'Create Product Type Has Diagnos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Type Has Diagnos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-has-diagnos-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
