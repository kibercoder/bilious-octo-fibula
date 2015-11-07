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
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="user-search">

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

        'role'=>[
              'type'=> Form::INPUT_WIDGET,
              'widgetClass' => kartik\widgets\Select2::className(),
              'options' => [
                  'data' => $model->getRoles(),
                  'options' => ['placeholder' => 'Выбрать...'],
                  'pluginOptions' => [
                      'allowClear' => true,
                  ],
              ],
          ],

        'status'=>[
              'type'=> Form::INPUT_WIDGET,
              'widgetClass' => kartik\widgets\Select2::className(),
              'options' => [
                  'data' => $model->getStatuses(),
                  'options' => ['placeholder' => 'Выбрать...'],
                  'pluginOptions' => [
                      'allowClear' => true,
                  ],
              ],
          ],

        'username'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Логин', 'maxlength'=>255]],
        'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email', 'maxlength'=>255]],
        
        'last_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Логин', 'maxlength'=>150]],
        'first_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email', 'maxlength'=>150]],
        'middle_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email', 'maxlength'=>150]],
        

    ]
    ]);

    ?>
    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default', 'style' => 'margin-left: 15px; margin-right: 10px']) ?>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default', 'onclick' => ' $.pjax.reload({container: "#w2", data: $("#w0").serialize()  }); ; return false;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
