<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Agreement $model
 */

$this->title = Yii::t('app', 'Update Agreement') . ': ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="agreement-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
