<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use common\models\Product;
$this->title = $item['type']['title'];

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

<!-- find -->
  <section class="block find">
    <div class="block-container">
      <input type="text" placeholder="Введите ключевое слово или название заболевания" />
      <a href="#" class="add">Добавить параметры</a>&nbsp;&nbsp;
      <a href="#" class="big">НАЙТИ</a>
    </div>
  </section>
<!-- /find -->

<!-- column2 -->
    <section class="block column2 product">
      <div class="block-container">
	
      	<!-- left -->
      	<div class="left product_page">
      		<div class="product_head ph2">
      			<h3><?= $item['type']['title'] ?>
              <span><?= $item['title'] ?></span>
      			</h3>
      			<div class="product_price">
      				<?= Product::priceFormat($item['price_discount']) ?>&nbsp;₽
      				<del><?= Product::priceFormat($item['price']) ?>&nbsp;₽</del>
      			</div>
      		</div>
      		<h4 class="for_buy">вы приступаете к оформлению покупки! будьте внимательны!</h4>
      		<div class="alred_reg">
      			<p>Уже зарегистрированы?</p>
      			<a href="/login" class="but">Войти</a>
      		</div>
      		<div class="without_reg" style="display: none;">
      			<p>Хочу приобрести продукт без регистрации.</p>
      		</div>
          
      		
          
            <div class="site-signup">
              <div class="row">
                  <div>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'reg-form' ]); ?>
                        <table width="100%">
                        <tbody>
                          <tr>
                            <td><?= $form->field($model_signup, 'last_name')
                                    ->textInput(array('placeholder' => 'Ваша фамилия')); ?></td>
                            <td><?= $form->field($model_signup, 'birthday_date')
                                    ->textInput(array('placeholder' => 'ДД.ММ.ГГГГ')); ?></td>
                          </tr>
                          <tr>
                            <td><?= $form->field($model_signup, 'first_name')
                                     ->textInput(array('placeholder' => 'имя')); ?></td>
                            <td><?= $form->field($model_signup, 'email')
                                    ->textInput(array('placeholder' => 'mail@mail.com')); ?></td>
                          </tr>
                          <tr>
                            <td><?= $form->field($model_signup, 'middle_name')
                                    ->textInput(array('placeholder' => 'и отчество')); ?></td>
                            <td><?= $form->field($model_signup, 'phone')
                                    ->textInput(array('placeholder' => '+7(xxx)xxx-xx-xx')); ?></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <div class="form-group">
                                <?= Html::submitButton('Зарегистрироваться и оплатить', ['class' => 'send-signup', 'name' => 'signup-button']) ?>
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
      	 <!-- /left -->
      	 <!-- right -->
      	<div class="right product_page ph2">
      		<h4>Уважаемый пользователь!</h4>
      		<br/>
      		<h4>мы ценим вашу приватность.<br/>наша система не требует<br/>обязательной регистрации для<br/>приобретения предлагаемых<br/>программ и товаров.</h4>
      		<br/>
      		<h4>при совершении покупки <br/>в нашей системе вам будет<br/>присвоен персональный номер,<br/>который будет необходим для<br/>общения с лечебными<br/>учреждениями.</h4>
      	</div>
      	 <!-- /right -->
	 
      </div>
    </section>
  <!-- /column2 -->