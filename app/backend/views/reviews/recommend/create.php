<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Recommend $model
 */
$this->title = Yii::t('app', 'Create Recommend');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recommends'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recommend-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
