<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;
use common\widgets\edit\InputFile;
use common\widgets\edit\Redactor;

/**
 * @var yii\web\View $this
 * @var common\models\Specialist $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="specialist-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'intro'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Краткое описание...','rows'=> 6],
                ],
            ], 
            
            'body'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ], 

'middle_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Отчество...', 'maxlength'=>255]], 

'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email...', 'maxlength'=>100]], 

'first_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Имя...', 'maxlength'=>255]], 

'last_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Фамилия...', 'maxlength'=>255]], 

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
                        'clearIncomplete' => true,
                    ]
                ]
            ], 

'photo_image'=>[
                    'type'=> Form::INPUT_WIDGET,
                    'widgetClass' => InputFile::className(),
                    'options' => [
                        'language'      => 'ru',
                        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                        'options'       => ['class' => 'form-control'],
                        'buttonOptions' => ['class' => 'btn btn-default'],
                        'multiple'      => false,       // возможность выбора нескольких файлов
                        'path'          => 'image',
                    ]
          ], 

/*'orgs_list'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( \common\models\Organization::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...', 'multiple' => true,],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10,
                    ],
                ],
            ],*/

'specTypes_list'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( \common\models\SpecialistType::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...', 'multiple' => true,],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10,
                    ],
                ],
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
