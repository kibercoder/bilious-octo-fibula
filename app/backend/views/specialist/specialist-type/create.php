<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SpecialistType $model
 */
$this->title = Yii::t('app', 'Create Specialist Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialist Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialist-type-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
