<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

$css =<<<CSS

.send-profile {
    color: #a52025;
    background: #fff;
    border: 0;
    overflow: visible;
    outline: 0;
    text-transform: uppercase;
    padding: 5px 10px;
    margin: 30px 0 0;
    border-radius: 14px;
    display: inline-block;
    cursor: pointer;    
    float: left;
    font-weight: 300;
    font-size: 15px;
}

.send-profile:hover {
    background: #a52025;
    color: #fff;
}

#form-profile label {
    float: left;
    text-align: left;
    min-width: 200px;
    display: inline-block;
    color: #a52025;
    text-transform: uppercase;
    position: relative; z-index: 1;
}

#form-profile div {
    margin: 15px 0 0; position: relative;
}

#form-profile input {
    position: relative; z-index: 1;
}

h4.for_buy {
    color: #3c3c3b;
    font-size: 18px;
    text-transform: uppercase;
    text-align: center;
    background: transparent url("../img/icon-82.png") no-repeat scroll 50% 0px;
    padding-top: 87px;
    padding-right: 40px;
    padding-bottom: 29px;
}

#form-profile .help-block-error {
    position: absolute; left: 200px; wite-space: nowrap; top: -15px; z-index: 0;
}

CSS;

$this->registerCss($css);

?>

<!-- column2 -->
<section class="block column2">
  <div class="block-container">

      <!-- column-left -->
      <div class="column-left">
          <h4>добрый день!</h4>
          <br />
          <h4>ваш персональный номер в нашей системе #12345678</h4>
          
          <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-profile', 'action' => '/user/profile']); ?>
                    <?= $form->field($model, 'last_name')
                                        ->textInput(array('placeholder' => 'Ваша фамилия')); ?>
                    <?= $form->field($model, 'first_name')
                                        ->textInput(array('placeholder' => 'имя')); ?>
                    <?= $form->field($model, 'middle_name')
                                        ->textInput(array('placeholder' => 'n отчество')); ?>
                    <?= $form->field($model, 'email')
                                        ->textInput(array('placeholder' => 'mail@mail.com')); ?>
                    <?= $form->field($model, 'birthday_date')
                                        ->textInput(array('placeholder' => 'ДД.ММ.ГГГГ')); ?>
                    <?= $form->field($model, 'phone')
                                        ->textInput(array('placeholder' => '+7(xxx)xxx-xx-xx')); ?>
                                        
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'confirmpassword')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'send-profile', 'name' => 'save-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
      </div>
      <!-- /column-left -->
      <!-- column-right -->
      <div class="column-right">
        <p></p>
      </div>
      <!-- /column-right -->

  </div>
</section>
<!-- /column2 -->

<?= $this->render('list_oders', ['model' => $model, 'orders' => $orders]) ?>