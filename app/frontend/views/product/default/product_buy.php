<?php

use common\models\Product;
$this->title = $item['type']['title'];

?>
<!-- find -->
<section class="block find">
  <div class="block-container">
    <input type="text" placeholder="Введите ключевое слово или название заболевания">
    <a href="#" class="add">Добавить параметры</a> <a href="#" class="big">НАЙТИ</a>
  </div>
</section>
    <!-- /find -->

<!-- column2 -->
      <section class="block column2 product">
        <div class="block-container">

    <!-- left -->
    <div class="left product_page">
      <div class="product_head ph2">
        <h3>
          <?= $item['type']['title'] ?>
          <span><?= $item['title'] ?></span>
        </h3>
        <div class="product_price">
          <?= Product::priceFormat($item['price_discount']) ?> ₽
          <del><?= Product::priceFormat($item['price']) ?> ₽</del>
        </div>
      </div>
      <h4 class="for_buy">для совершения покупки проверьте свои данные,<br/>выбранный продукт и подтвердите согласие с условиями договора</h4>
      <h3><?= $item['title_full'] ?></h3>
      <p><?= $item['body_buy'] ?></p>
      <div class="contact_info" style="margin-top: 5px; height: 80px">
        <h4>контактная информация</h4>
        <div class="contact_info_line">
          <h5>8 (499) 367-52-72</h5>
          <p>Головатый Вячеслав Владимирович - менеджер компании IHealth.ru</p>
        </div>
      </div>

	  <h3><?=$item['agreement']['title']?></h3>
	  <div class="agreement_block"><?=$item['agreement']['body']?></div>

      <div data-function="pay_step1" style="cursor: pointer;">
        <div class="thanx_block2">
          <p>я подтверждаю свое согласие с условиями договора</p>
          <h4>оплатить</h4>
        </div>
      </div>

      <div style="display:none" class="product_buy_card">

        <div class="pur_prod">
          <div class="pur_prod_line">
            <h4>приобретаемый продукт</h4>
            <h5><?=$item['title']?></h5>
          </div>
          <div class="pur_prod_line">
            <h4>стоимость заказа</h4>
            <h5><?=$item['price_discount_format']?>&nbsp;₽</h5>
          </div>
        </div>
        <p class="up_p">на данный момент мы принимаем оплату<br/>только по банковским картам</p>
        <div class="left_card">
          <div class="left_card_input">
            <h4>Номер карты</h4>
            <input id="card_number" type="text" placeholder="3446-8245-1223-6433" />
          </div>
          <div class="left_card_input">
            <h4>Имя (как на карте)</h4>
            <input id="card_name" type="text" />
          </div>
          <div class="left_card_input">
            <h4>Действует до</h4>
            <input id="card_term" type="text" placeholder="21.10.2010" />
          </div>
        </div>
        <div class="right_card">
          <div class="right_card_input">
            <h4>Cvc/cvv</h4>
            <input id="card_code" type="text" />
          </div>
          <p>CVC/CVV код написан на оборотной стороне карты</p>
        </div>
        <input class="card_submit" type="submit" value="Оплатить" data-function="pay_step2" />

      </div>

      <div class="thanx_block" style="display:none">
              <p>
                уважаемый <?=$user->first_name;?>!<br/>мы глубоко признательны,<br/>
                что вы воспользовались услугами нашего сервиса.</p>
                <p>вы оплатили продукт - биопсия простаты VIP</p>
                <p>в ближайшее время мы свяжемся с вами<br/>для подтверждения заказа.</p>
                <p>детальные параметры заказа высланы<br/>на вашу электронную почту,<br/>указанную в регистрационной форме.
              </p>
      </div>

      <!--
      <a href="#" class="pay_link">Отменить</a>
      -->
    </div>
     <!-- /left -->

     <!-- right -->
    <div class="right product_page ph2">
      <h4>Уважаемый <?=$user->first_name;?>!</h4>
      <br />
      <h4 class="pers_num">ваш персональный номер<br/>в нашей системе #<?=$user->id?></h4>
      <p>
          <?=$user->last_name;?><br/>
          <?=$user->first_name;?><br/>
          <?=$user->middle_name;?>
      </p>
      <br />
      <h4>Дата рождения</h4>
      <p><?=date('d.m.Y',strtotime($user->birthday_date));?></p>
      <br />
      <h4>mail</h4>
      <p><?=$user->email;?></p>
      <br />
      <h4>телефон</h4>
      <p><?=$user->phone;?></p>
      <br /><br /><br />
      <p><a href="/user/profile" class="but">Редактировать</a></p>
    </div>
     <!-- /right -->

        </div>

      </section>
    <!-- /column2 -->

<?php return ?>

<h1><?= $item['type']['title'] ?>: <?= $item['title'] ?></h1><br/>
<?= Product::priceFormat($item['price']) ?><br/>
<?= Product::priceFormat($item['price_discount']) ?><br/><br/>

<b><?= $item['type']['title'] ?></b><br/>
<?= $item['type']['body'] ?><br/><br/>


<b>Точное наименование продукта</b><br/>
<?= $item['type']['title'] ?><br/><br/>

<b>План лечения</b><br/>
<?= $item['intro'] ?><br/><br/>

<b><?= $item['organization']['title'] ?></b><br/>
<?= $item['organization']['body'] ?><br/>
