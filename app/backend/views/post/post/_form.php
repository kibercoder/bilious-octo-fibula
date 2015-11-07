<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;

use common\widgets\elfinder\InputFile;



use yii\bootstrap\Modal;


use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;


/**
 * @var yii\web\View $this
 * @var common\models\Post $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Заголовок...', 'maxlength'=>255]],

'intro'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>\vova07\imperavi\Widget::className(),
                'options' => [
                    'settings'=>[
                        'toolbarFixed'=>false,
                        'minHeight' => 100,
                        'plugins' => ['elfinder', 'fontcolor'],
                    ],
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

'user_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'category_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\PostCategory::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'state_index'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => (new common\models\Post)->getStateIndexList(),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'main_flag'=>['type'=> Form::INPUT_CHECKBOX, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Главная...']],

'noforeign_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Noforeign ID...', 'maxlength'=>11]],

'created_datetime'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]],

'start_date'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]],

'start_time'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_TIME]],

'preview_image'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => InputFile::className(),
          'options' => [
              'language'      => 'ru',
              'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
              'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
              'options'       => ['class' => 'form-control'],
              'buttonOptions' => ['class' => 'btn btn-default'],
              'multiple'      => false,       // возможность выбора нескольких файлов
              'path'          => 'news',
          ],
      ],

'doc_file'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => InputFile::className(),
          'options' => [
              'language'      => 'ru',
              'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
              'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
              'options'       => ['class' => 'form-control'],
              'buttonOptions' => ['class' => 'btn btn-default'],
              'multiple'      => false,       // возможность выбора нескольких файлов
              'path'          => 'news',
          ],
      ],

    ]
    ]);

/*
        ?>

        <script>

              if (!RedactorPlugins) var RedactorPlugins = {};

              RedactorPlugins.elfinder = function()
              {
                  return {
                      init: function()
                      {
                          var elfinder = this.button.add('elfinder', 'Elfinder');
                          this.button.setAwesome('elfinder', 'fa-elfinder');
                          this.button.addCallback(elfinder, this.elfinder.openElfinder);
                      },
                      openElfinder: function()
                      {
                          $('#redactor-dialog').modal('show');
                      },
                  };
              };

        </script>

        <?php

        // Print elfinder widget in modal
         Modal::begin([
            //'header' => '<h2>Hello world</h2>',
            'toggleButton' => false,
            'id' => 'redactor-dialog',
            'size' => Modal::SIZE_LARGE,
        ]);

        echo ElFinder::widget([
            'language'         => 'ru',
            'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'path' => '', // будет открыта папка из настроек контроллера с добавлением указанной под деритории
            'filter'  => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
            'callbackFunction' => new JsExpression('function(file, id){

                //$("#' . 'id' . '").val( file.url );
                //$("#' . 'id' . '-thumb").attr("src", file.url ).show();
                $("#' . 'redactor' . '-dialog").modal("hide");

            }'), // id - id виджета

            'frameOptions' => ['style' => 'width: 100%; height: 500px; border: 0px;']
        ]);

        Modal::end();

*/


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
