<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Diagnos $model
 */
$this->title = Yii::t('app', 'Create Diagnos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diagnos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diagnos-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
