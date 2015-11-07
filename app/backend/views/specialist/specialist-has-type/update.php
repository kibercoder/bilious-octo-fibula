<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SpecialistHasType $model
 */

$this->title = Yii::t('app', 'Update Specialist Has Type') . ': ' . $model->spec_id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialist Has Types'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->spec_id, 'url' => ['update', 'spec_id' => $model->spec_id, 'spec_type_id' => $model->spec_type_id]];
$this->params['breadcrumbs'][] = $model->spec_id;
?>
<div class="specialist-has-type-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
