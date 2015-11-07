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
 * @var common\models\Specialist $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="specialist-search">

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

 

//'middle_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Отчество...', 'maxlength'=>255]], 

//'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email...', 'maxlength'=>100]], 

//'first_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Имя...', 'maxlength'=>255]], 

//'last_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Фамилия...', 'maxlength'=>255]], 

'phone'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => yii\widgets\MaskedInput::className(),
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => yii::t('app', 'Enter').' Телефон...'
                    ],
                    'mask' => '+7(999)999-99-99',
                    'clientOptions' => [
                        'clearIncomplete' => false,
                    ]
                ]
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
