<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Recommend $model
 */

$this->title = Yii::t('app', 'Update Recommend') . ': ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recommends'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="recommend-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
