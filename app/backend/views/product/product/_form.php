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
 * @var common\models\Product $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data']
    ]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'organization_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\Organization::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'type_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\ProductType::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],

'specialist_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\Specialist::find()->all(), 'id', 'last_name'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],


'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название продукта...', 'maxlength'=>255]],

    //'title_mid'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').$model->getAttributeLabel('title_mid'), 'maxlength'=>255]],

    'title_full'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').$model->getAttributeLabel('title_full'), 'maxlength'=>255]],

'price'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Цена...']],
'price_discount'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Цена со скидкой...']],


'intro'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
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

'body_buy'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание для покупки...','rows'=> 6],
                ],
            ],

'keywords'=>['type'=> Form::INPUT_TEXT, 'options'=>[
      'placeholder'=>yii::t('app', 'Enter').' Ключевые слова...',
      'maxlength'=>255
      ],
],

'priority'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название продукта...', 'maxlength'=>255]],

'agreement_id'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\Agreement::find()->all(), 'id', 'title'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],



/*'results'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ],
*/

//'orientation'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Направленность...', 'maxlength'=>255]],

//'tags'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Теги для поиска...', 'maxlength'=>255]],

/*'recommend'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ],

'prepare'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ],
*/


//'group_services'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Группа услуг...', 'maxlength'=>255]],

//'notes'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Особые отметки...', 'maxlength'=>255]],

/*
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
                    ]
          ],

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
                        'path'          => 'image',
                    ]
          ],
  */

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
