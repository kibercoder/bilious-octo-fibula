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
 * @var common\models\SliderImage $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="slider-image-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'publish_flag'=>['type'=> Form::INPUT_CHECKBOX, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Опубликовано...']], 

'slider'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Слайдер...']], 

'href'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Ссылка...', 'maxlength'=>255]], 

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

'menu_image'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  'accept' => 'image/*',
                  'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => $model->getUploadUrl('menu_image')
                      ? Html::img($model->getUploadUrl('menu_image'), ['class' => 'file-preview-image'])
                      : false,
                  'maxFileCount' => 1
              ]
          ]
      ], 

'href_enabled_flag'=>['type'=> Form::INPUT_CHECKBOX, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Показывать кнопку перейти...']], 

'created_date'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]], 

'iframe_href'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Ссылка на iframе(если указан изображения игнорируются)...', 'maxlength'=>255]], 

'banner_image'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  'accept' => 'image/*',
                  'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => $model->getUploadUrl('banner_image')
                      ? Html::img($model->getUploadUrl('banner_image'), ['class' => 'file-preview-image'])
                      : false,
                  'maxFileCount' => 1
              ]
          ]
      ], 

'banner_phone_image'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  'accept' => 'image/*',
                  'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => $model->getUploadUrl('banner_phone_image')
                      ? Html::img($model->getUploadUrl('banner_phone_image'), ['class' => 'file-preview-image'])
                      : false,
                  'maxFileCount' => 1
              ]
          ]
      ], 

'banner_tablet_image'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  'accept' => 'image/*',
                  'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => $model->getUploadUrl('banner_tablet_image')
                      ? Html::img($model->getUploadUrl('banner_tablet_image'), ['class' => 'file-preview-image'])
                      : false,
                  'maxFileCount' => 1
              ]
          ]
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
