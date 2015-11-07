<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('app', 'Пользователь') . ': ' . $model->username;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->username;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
