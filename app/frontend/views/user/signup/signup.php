<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

$css =<<<CSS

.send-signup {
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

.send-signup:hover {
    background: #a52025;
    color: #fff;
}

#form-signup label {
    float: left;
    text-align: left;
    min-width: 100px;
    display: inline-block;
    color: #a52025;
    text-transform: uppercase;
    position: relative; z-index: 1;
}

#form-signup td input {
    float: right; position: relative; z-index: 1;
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

#form-signup {
    text-align: center; width: 100%;
}

#form-signup table tr td:first-child {
    padding: 7px 50px 7px 0 !important; width: 45%;
}

#form-signup table tr td {
    padding: 7px 0 7px 60px; width: 55%;
}

#form-signup table td div {
    position: relative;
}

#form-signup table .help-block-error {
    position: absolute; left: 0; wite-space: nowrap; top: -15px; z-index: 0;
}



CSS;

$this->registerCss($css);

?>

<!-- block1 -->
  <section class="block column2">
      <div class="block-container">

          <!-- column-left -->
          <div class="column-left">
        
            <div class="body">

                <p align="center"><img src="/img/icon-8.png" alt="" /></p>
                <h5>Уважаемый клиент!</h5>
                <h5>
                  мы ценим вашу приватность.<br />
                  наша система не требует обязательной регистрации для приобретения 
                  предлагаемых программ и товаров.
                </h5>
                <h5>
                    при совершении покупки в нашей системе вам будет присвоен 
                    персональный номер, который будет необходим для общения с лечебными учреждениями.
                </h5>
                
                <br /><br />
        
                <div class="site-signup">
                  
                  <div class="row">
                      <div>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'reg-form' ]); ?>
                            <table width="100%">
                            <tbody>
                              <tr>
                                <td><?= $form->field($model, 'last_name')
                                        ->textInput(array('placeholder' => 'Ваша фамилия')); ?></td>
                                <td><?= $form->field($model, 'birthday_date')
                                        ->textInput(array('placeholder' => 'ДД.ММ.ГГГГ')); ?></td>
                              </tr>
                              <tr>
                                <td><?= $form->field($model, 'first_name')
                                         ->textInput(array('placeholder' => 'имя')); ?></td>
                                <td><?= $form->field($model, 'email')
                                        ->textInput(array('placeholder' => 'mail@mail.com')); ?></td>
                              </tr>
                              <tr>
                                <td><?= $form->field($model, 'middle_name')
                                        ->textInput(array('placeholder' => 'и отчество')); ?></td>
                                <td><?= $form->field($model, 'phone')
                                        ->textInput(array('placeholder' => '+7(xxx)xxx-xx-xx')); ?></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'send-signup', 'name' => 'signup-button']) ?>
                                  </div>
                                </td>
                              </tr>
                              </tbody>
                            </table>
                        <?php ActiveForm::end(); ?>
        
                      </div>
                  </div>
                </div>
        
        </div>
        
        </div>

      </div>
  </section>
