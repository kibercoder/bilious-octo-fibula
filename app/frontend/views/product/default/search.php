<!-- column2 -->
      <section class="block column2 product">
        <div class="block-container">

    <!--
    <div class="ask_consult">
      <h2>спросите нашего консультанта</h2>
      <p>Медицинские консультанты  помогут Вам найти ответ на любой вопрос.<br/>Сообщите нам, что Вас интересует, и мы свяжемся с Вами в кратчайшие сроки.</p>
      <a href="#">Отправить запрос на лечение</a>
    </div>
    -->

<!-- left -->

<div class="left product_page">

<?php if($query): ?>
    <h3>Результаты поиска по &laquo;<?= $query ?>&raquo;</h3>
<?php endif ?>


<?php foreach($productList as $cat): ?>

<?php if( sizeof( $cat['list'] ) == 0 ) continue; ?>

<h2><?= $cat['title'] ?><span><?= $cat['desc'] ?></span></h2>

  <?php foreach($cat['list'] as $item): ?>

  <!--
    <div class="diagnost_block">
      <h3>Комплексная диагностика мужского здоровья</h3>
      <h4>НИИ урологии имени Н.А. Лопаткина</h4>
      <p>Диагностика – это процесс установления диагноза, то есть заключения о сущности болезни и состоянии пациента, выраженное в принятой медицинской терминологии. Диагностика основывается на всестороннем и систематическом изучении ...</p>
      <a href="#" class="but">Подробнее</a>
    </div>
    -->

    <?php if( $item['specialist_id'] > 0 ): ?>

    <div class="product_page_one" id_product="<?=$item['id']?>">
      <h3>
          <?=$item['specialist']['last_name']?><br />
          <?=$item['specialist']['first_name']?>
          <?=$item['specialist']['middle_name']?>
      </h3>
      <p class="big grey">ПРОКТОЛОГ, ХИРУРГ</p>
      <p class="cost">
          <span><?= $item['price_discount_format'] ?>&nbsp;<b>₽</b></span>
          <del><?= $item['price_format'] ?>&nbsp;₽</del>
      </p>

      <h4>Описание</h4>
      <p><?= $item['intro'] ?></p>

      <h4><?= $item['organization']['title'] ?></h4>
      <p><?= $item['organization']['address'] ?><br />
        <span class="phone"><?= $item['organization']['phone'] ?></span>
        <span class="phone"><?= $item['organization']['phone2'] ?></span>
      </p>
      <a href="/product/<?= $item['id'] ?>" class="but">Подробнее</a>
    </div>

    <?php else: ?>

    <div class="product_page_one" id_product="<?=$item['id']?>">
      <h3><?= $item['type']['title'] ?></h3>
      <p class="big grey"><?= $item['title'] ?></p>

      <p class="cost">
          <span><?= $item['price_discount_format']?>&nbsp;<b>₽</b></span>
          <del><?= $item['price_format']?>&nbsp;₽</del>
      </p>

      <h4>Описание</h4>
      <p><?= $item['intro'] ?></p>

      <h4><?= $item['organization']['title'] ?></h4>
      <p><?= $item['organization']['address'] ?><br />
        <span class="phone"><?= $item['organization']['phone'] ?></span>
        <span class="phone"><?= $item['organization']['phone2'] ?></span>
      </p>


      <a href="/product/<?= $item['id'] ?>" class="but">Подробнее</a>
    </div>

    <?php endif ?>

  <?php endforeach ?>

<!--
<a href="#" class="read_more">открыть больше</a>
-->

<?php endforeach ?>

</div>
 <!-- /left -->

<?= $this->render('_right_block_search', $blockData) ?>


        </div>
      </section>
    <!-- /column2 -->
                 <section class="block ban">
        <div class="block-container">
    <p></p>
        </div>
      </section>

<?php return; ?>