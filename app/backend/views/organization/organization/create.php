<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Organization $model
 */
$this->title = Yii::t('app', 'Create Organization');
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
