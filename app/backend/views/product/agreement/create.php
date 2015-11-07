<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Agreement $model
 */
$this->title = Yii::t('app', 'Create Agreement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreement-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
