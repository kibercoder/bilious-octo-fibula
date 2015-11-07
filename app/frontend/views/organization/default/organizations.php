
<!-- ban2 -->
      <section class="block ban2">
        <div class="block-container">
		<p></p>
        </div>
      </section>
	  <!-- /ban2 -->


	  <!-- clinic -->
      <section class="block">
        <div class="block-container">

		<h1>НАШИ КЛИНИКИ</h1>
		<div class="tbl3">

    <?php $index =0 ; ?>
		<?php foreach( $orgList as $item ): $index++ ?>

  <div class="col"><p><img src="/img/clin-ico-1.png" alt=""></p><h3><?= $item['title'] ?></h3>
  <p><?= $item['intro'] ?>
  <br>
  <?= $item['phone'] ?><br>
  <?= $item['phone2'] ?></p>
  <a href="/organization/<?=$item['id'] ?>" class="but">Подробнее</a></div>

  <?php if( $index%3==0 ): ?>
  <div class="clear"></div>
  <?php endif ?>

  <?php endforeach ?>

</div>

<!--
<p align="center"><a href="#" class="button">открыть больше</a></p>
-->

        </div>
      </section>
	  <!-- /clinic -->

<!-- ban -->
      <section class="block ban">
        <div class="block-container">
		<p></p>
        </div>
      </section>
	  <!-- /ban -->



	  <!-- look -->
      <section class="block look look-img">
        <div class="block-container">

		<h1>ВАС МОЖЕТ ЗАИНТЕРЕСОВАТЬ</h1>
		<div class="tbl3">
  <div class="col">
  <p class="icon"><img src="img/icon-7.png" alt=""></p>
  <h3>ЛЕЧЕНИЕ АДЕНОМЫ ПРОСТАТЫ</h3>
  <p class="big grey">СТАНДАРТ</p>
  <p class="cost"><span>57,300.00 <b>₽</b></span><del>71,000.00 ₽</del></p>
<h4>НИИ урологии имени Н.А. Лопаткина</h4>
<p>105425, г. Москва, ул. 3-я Парковая, дом 51<br>
8 (499) 367-52-72<br>
8 (499) 367-84-18</p>

<p>Стандартная трансректальная биопсия из 12-14 точек под ультразвуковым контролем, размещение в 2-3 местной палате, анестезия на выбор пациента.</p>

  <a href="#" class="but">Подробнее</a></div>

  <div class="col">
  <p><img src="img/img-1.jpg" alt=""></p>
  <h3>ЗАГРЯДСКИЙ<br>Евгений Алексеевич</h3>
  <p>ПРОКТОЛОГ, ХИРУРГ</p>
  <p class="cost">Первичный прием <span>2,300.00 <b>₽</b></span></p>
  <p>Биопсия предстательной железы – диагностическая процедура, позволяющая в полной мере оценить процессы, происходящие в предстательной железе.</p>
  <a href="#" class="but" tabindex="0">Подробнее</a></div>

  <div class="col">
  <p class="icon"><img src="img/clin-ico-3.png" alt=""></p>
  <h3>НИИ им. Н.Ф. Гамалеи</h3>
    <p>НИИ урологии и интервенционной радиологии имени Н.А. Лопаткина Филиал ФГБУ НМИРЦ Минздрава России<br>
105425, г. Москва, ул. 3-я Парковая, дом 51<br>
8 (499) 367-52-72<br>
8 (499) 367-84-18</p>
  <a href="#" class="but">Подробнее</a></div>

</div>

        </div>
      </section>
	  <!-- /look -->
