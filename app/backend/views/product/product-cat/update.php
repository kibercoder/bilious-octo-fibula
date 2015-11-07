<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ProductCat $model
 */

$this->title = Yii::t('app', 'Update Product Cat') . ': ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Cats'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="product-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
