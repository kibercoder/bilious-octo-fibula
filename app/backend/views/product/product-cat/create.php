<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\ProductCat $model
 */
$this->title = Yii::t('app', 'Create Product Cat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cat-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
