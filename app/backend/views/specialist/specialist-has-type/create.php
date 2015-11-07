<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SpecialistHasType $model
 */
$this->title = Yii::t('app', 'Create Specialist Has Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialist Has Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialist-has-type-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
