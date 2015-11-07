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
 * @var common\models\ProductType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-type-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'cat_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\ProductCat::find()->where(['>', 'parent_id', '0'])->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название типа продукта...', 'maxlength'=>255]],

//'title_mid'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название - title_mid...', 'maxlength'=>255]],

//'title_full'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название - title_full...', 'maxlength'=>255]],

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


'body'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ],

'type_index'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => (new common\models\ProductType)->getTypeIndexList(),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'diagnoses_list'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( \common\models\Diagnos::find()->all(), 'id', 'title'),
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
