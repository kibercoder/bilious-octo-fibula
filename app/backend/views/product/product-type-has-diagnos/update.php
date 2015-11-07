<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ProductTypeHasDiagnos $model
 */

$this->title = Yii::t('app', 'Update Product Type Has Diagnos') . ': ' . $model->diagnos_id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Type Has Diagnos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->diagnos_id, 'url' => ['update', 'diagnos_id' => $model->diagnos_id, 'product_type_id' => $model->product_type_id]];
$this->params['breadcrumbs'][] = $model->diagnos_id;
?>
<div class="product-type-has-diagnos-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
