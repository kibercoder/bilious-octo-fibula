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
 * @var common\models\Order $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="order-search">

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

'status_index'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => (new common\models\Order)->getStatusIndexList(),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ], 

//'summ'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Сумма заказа...']], 

//'created_datetime'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]], 

//'finished_datetime'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]], 

    ]
    ]);

    ?>
    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default', 'style' => 'margin-left: 15px; margin-right: 10px']) ?>
        <?= Html::submitButton(Yii::t('app',Yii::t('app', 'Search')), ['class' => 'btn btn-default', 'onclick' => ' $.pjax.reload({container: "#w2", data: $("#w0").serialize()  }); return false;']) ?>
  
    </div>

    <?php ActiveForm::end(); ?>

</div>
