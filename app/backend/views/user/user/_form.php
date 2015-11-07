<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;

use kartik\grid\GridView;

use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php

    $this->registerJs(
        '$("document").ready(function(){
            $("#w0").on("pjax:end", function() {
              alert("Hi there");
              //$.pjax.reload({container:"#w3"});  //Reload GridView
            });
        });
        
        $("document").ready(function(){
        
          $.post(
            "activateusers", 
            {
                pk : $("#w3").yiiGridView("getSelectedRows")
            },
            function (data) {
                $.pjax.reload({container:"#w3"});
          });
        
        });'
    );
?>

<div class="user-form">

<?php Pjax::begin(['options' => ['id'=>'w0', 'timeout'=>3000]]); ?>

    <?php $form = ActiveForm::begin([
          'enableClientValidation' => true,
          'type'=>ActiveForm::TYPE_HORIZONTAL,
          'options'=>['enctype'=>'multipart/form-data', ['data-pjax' => true]]
    ]);
    
    /*$dataProvider = array(1,2,3,4,5);
    echo TabularForm::widget([
        'form' => $form,
        'dataProvider' => $dataProvider,
        'attributes' => [
            'role' => [
                'id' => TabularForm::INPUT_DROPDOWN_LIST, 
                'items'=>['0' => 'Активный','1' => 'Отключен','2'=>'Удален']
            ],
        ],
    ]);*/
    
    
    $params = [
        //'prompt' => 'Роль...',
    ];
    
    echo $form->field($model, 'role')->dropDownList($model->getRoles(),$params);
    
    $params2 = [
        //'prompt' => 'Статус...',
    ];
    
    echo $form->field($model, 'status')->dropDownList($model->getStatuses(),$params2);

    echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [
    
    'last_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Фамилия...', 'maxlength'=>150]], 
    
    'first_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Имя...', 'maxlength'=>255]], 
    
    'middle_name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Отчество...', 'maxlength'=>255]], 

//'username'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Имя пользователя...', 'maxlength'=>255]], 

    'birthday_date' => ['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Дата рождения...', 'maxlength'=>10, 'value'=>$model->birthday_date]],


'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Email...', 'maxlength'=>255]], 

//'role'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Роль...']], 

//'status'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=> yii::t('app', 'Enter').' Состояние...']], 

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
            
            
      'password'=>['type'=> Form::INPUT_PASSWORD, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Пароль', 'maxlength'=>20]],
      'confirmpassword'=>['type'=> Form::INPUT_PASSWORD, 'options'=>['placeholder'=>yii::t('app', 'Enter').' Повтор пароля', 'maxlength'=>20]],

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
