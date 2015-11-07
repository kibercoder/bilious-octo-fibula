<?php

$this->title = $item['title'];

?>

	 <!-- ban3 -->
      <section class="block ban3">
        <div class="block-container">
		      <p></p>
        </div>
      </section>
	  <!-- /ban3 -->


	  <!-- clinic -->
      <section class="block">
        <div class="block-container">

		<h1><?= $item['title'] ?></h1>
		<div class="tbl3">

<?php $index = 0; ?>
<?php foreach( $productList as $item ): $index++ ?>

  <div class="col">

  <?php if($item['type']['icon_image']): ?>
  <p class="icon"><img src="<?= $item['type']['icon_image']; ?>" alt=""></p>
  <?php endif ?>

  <h3><?= $item['type']['title'] ?></h3>

  <p class="big grey"><?= $item['title'] ?></p>
  <p class="cost"><span><?= $item['price_discount_format'] ?> <b>₽</b></span><del><?= $item['price_format'] ?> ₽</del></p>

  <p><?= $item['intro'] ?></p>
  <h4><?= $item['organization']['title'] ?></h4>


  <a href="/product/<?= $item['id'] ?>" class="but">Подробнее</a>
  </div>

  <?php if( $index % 3 == 0 ): ?>
  <div class="clear"></div>
  <?php endif ?>

<?php endforeach ?>



<!--
<p align="center"><a href="#" class="button">открыть больше</a></p>
-->

        </div>
      </section>
	  <!-- /clinic -->

<!-- ban -->
<section class="block ban6">
    <div class="block-container">
		  <h1>Запросите примерную оценку<br />стоимости Вашего лечения</h1>
      <p>Медицинские консультанты  помогут Вам найти ответ на любой вопрос.<br />
      Сообщите нам, что Вас интересует, и мы свяжемся с Вами в кратчайшие сроки.</p>
      <br />
      <p><a href="#" class="but1">Отправить запрос на лечение</a></p>
    </div>
  </section>
<!-- /ban -->

    <?= $this->render('_adv_block', ['randProduct' => $randProduct, 'randOrg' => $randOrg, 'randSpec' => $randSpec]) ?>

