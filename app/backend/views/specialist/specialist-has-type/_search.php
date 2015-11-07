<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;

use kartik\builder\TabularForm;

/**
 * @var yii\web\View $this
 * @var common\models\SpecialistHasType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="specialist-has-type-search">

    <?php $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_HORIZONTAL,
        'action' => ['index'],
        'method' => 'get',
    ]);
    echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 2,

    'attributes' => [

'spec_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\Specialist::find()->all(), 'id', 'id'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ], 

'spec_type_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\SpecialistType::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ], 

    ]
    ]);

    ?>
    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default', 'style' => 'margin-left: 15px; margin-right: 10px']) ?>
        <?= Html::submitButton(Yii::t('app',Yii::t('app', 'Search')), ['class' => 'btn btn-default', 'onclick' => ' $.pjax.reload({container: "#w2", data: $("#w0").serialize()  }); return false;']) ?>
  
    </div>

    <?php ActiveForm::end(); ?>

</div>
