<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Specialist $model
 */
$this->title = Yii::t('app', 'Create Specialist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialist-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
