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
 * @var common\models\Organization $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Заголовок...', 'maxlength'=>255]],

//'keywords'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Ключевые слова...', 'maxlength'=>255]],

'main_image'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => InputFile::className(),
                'options' => [
                    'language'      => 'ru',
                    'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                    'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                    'options'       => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'multiple'      => false,       // возможность выбора нескольких файлов
                    'path'          => 'organization',
                ],
            ],

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


'doc_body' =>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Договор...','rows'=> 6],
                ],
            ],

'address'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Адресс...', 'maxlength'=>150]],

'metro'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Метро...', 'maxlength'=>50]],

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

'phone2'=>[
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

'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email...', 'maxlength'=>50]],

'priority'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Заголовок...', 'maxlength'=>255]],

'type_index'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => (new common\models\Organization)->getTypeIndexList(),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'icon_image'=>[
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
                ],
            ],

//'city'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Город...', 'maxlength'=>30]],

//'region'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Область...', 'maxlength'=>30]],

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
