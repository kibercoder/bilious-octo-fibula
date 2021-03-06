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
 * @var common\models\Product $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-search">

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

//'keywords'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Ключевые слова...', 'maxlength'=>255]], 

 

 

 

//'orientation'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Направленность...', 'maxlength'=>255]], 

//'tags'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Теги для поиска...', 'maxlength'=>255]], 

 

 

//'price_discount'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Цена со скидкой...']], 

//'price'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Цена...']], 

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

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Название продукта...', 'maxlength'=>255]], 

//'group_services'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Группа услуг...', 'maxlength'=>255]], 

//'notes'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Особые отметки...', 'maxlength'=>255]], 

 

 

    ]
    ]);

    ?>
    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default', 'style' => 'margin-left: 15px; margin-right: 10px']) ?>
        <?= Html::submitButton(Yii::t('app',Yii::t('app', 'Search')), ['class' => 'btn btn-default', 'onclick' => ' $.pjax.reload({container: "#w2", data: $("#w0").serialize()  }); return false;']) ?>
  
    </div>

    <?php ActiveForm::end(); ?>

</div>
