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
 * @var common\models\ServiceType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="service-type-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Заголовок...', 'maxlength'=>255]], 

'keywords'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Ключевые слова...', 'maxlength'=>255]], 

'intro'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>\vova07\imperavi\Widget::className(),
                'options' => [
                    'settings'=>[
                        'toolbarFixed'=>false,
                        'minHeight' => 100,
                    ]
                ],
                //'type'=> Form::INPUT_TEXTAREA
                //'options'=>['placeholder'=>yii::t('app', 'Enter').' Описание...','rows'=> 6]
            ], 

'body'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>\vova07\imperavi\Widget::className(),
                'options' => [
                    'settings'=>[
                        'toolbarFixed'=>false,
                        'minHeight' => 100,
                    ]
                ],
                //'type'=> Form::INPUT_TEXTAREA
                //'options'=>['placeholder'=>yii::t('app', 'Enter').' Текст...','rows'=> 6]
            ], 

    ]
    ]);

    echo Html::button(
        Yii::t('app', 'Cancel'),
        [
            'class' => 'btn btn-default',
            'style' => 'margin-right: 20px',
            'onclick' => 'window.location = "' . Url::to(['index']) . '"'
        ]
    );

    echo Html::submitButton(
        $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
        [
            'class' => 'btn btn-primary',
            'style' => 'margin-right: 10px',
            'name' => 'goto',
            'value' => 'list'
        ]
    );

    echo Html::submitButton(
        Yii::t('app', 'Apply'),
        [
            'class' => 'btn btn-primary',
            'style' => 'margin-right: 0px',
        ]
    );

    ActiveForm::end(); ?>

</div>
