

	  	  	  <!-- find -->
      <section class="block find">
        <div class="block-container">

<input type="text" placeholder="Введите ключевое слово или название заболевания"> <a href="#" class="add">Добавить параметры</a> <a href="#" class="big">НАЙТИ</a>

        </div>
      </section>
	  <!-- /find -->




<!-- column2 -->
      <section class="block column2 product">
        <div class="block-container">

		<!-- left -->
		<div class="left product_page">

<?php foreach($productList as $item): ?>

			<div class="product_head">
				<h3><?= $item['type']['title'] ?>
					<span><?= $item['title'] ?></span>
				</h3>
				<div class="product_price">
					<?= $item['price_discount'] ?> ₽
					<del><?= $item['price'] ?> ₽</del>
				</div>
				<a href="/product/<?= $item['id'] ?>">Купить</a>
			</div>
			<h3><?= $item['title'] ?></h3>
			<!--<h3><?//= $item['title_full'] ?></h3>-->
			<p><?= $item['type']['body'] ?></p>
			<h4>точное наименование продукта</h4>
			<p>Трансректальная биопсия из 12-14 точек под контролем гистосканирования.</p>
			<h4>План лечения и оказываемые услуги</h4>
			<?= $item['intro'] ?>
			<!--<ul>
				<li>1. Прием уролога первичный</li>
				<li>2. Лабораторные и диагностические исследования в составе:
					<ul>
						<li>a. Общий анализ крови,</li>
						<li>b. Общий анализ мочи, Биохимический анализ крови,</li>
						<li>c. Группа крови, резус-фактор, RW, BИЧ, HBs, HCs- антиген, Коагулограмма, </li>
						<li>d. ЭКГ + консультация терапевта,</li>
						<li>e. Флюрограмма/рентгенография органов грудной клетки)</li>
					</ul>
				<li>3. Подготовка к операции</li>
				<li>4. Операция</li>
				<li>5. Послеоперационное сопровождение.</li>
			</ul>

			<p>Операция проводится в госпитале 3 Урологического отделения. Анестезия на выбор пациента. Отдельная одноместная палата. Трехразовое питание. Полное медикаметозное и медсестринское сопровождение в НИИ Урологии.</p>
			-->

			<h4><?= $item['organization']['title'] ?></h4>
			<p class="last">
			    <?= $item['organization']['address'] ?>
			    <span><?= $item['organization']['phone'] ?></span>
			    <span><?= $item['organization']['phone2'] ?></span>
			    <?= $item['organization']['body'] ?>
			</p>

<?php endforeach ?>





		</div>
		 <!-- /left -->


		 <!-- right -->
		<div class="right product_page">
			<div class="product_page_one">
				<h3 class="icon-1">БИОПСИЯ ПРОСТАТЫ</h3>
				<p class="big grey">СТАНДАРТ</p>
				<p class="cost"><span>57,300.00 <b>₽</b></span><del>71,000.00 ₽</del></p>
				<h4>НИИ урологии имени Н.А. Лопаткина</h4>
				<p>105425, г. Москва, ул. 3-я Парковая, дом 51<br>
					<span class="phone">8 (499) 367-52-72</span><br>
					<span class="phone">8 (499) 367-84-18</span></p>
				<p><br>Стандартная трансректальная биопсия из 12-14 точек под ультразвуковым контролем, размещение в 2-3 местной палате, анестезия на выбор пациента.</p>
				<a href="#" class="but">Подробнее</a>
			</div>
			<div class="product_page_one">
				<h3 class="icon-1">БИОПСИЯ ПРОСТАТЫ</h3>
				<p class="big grey">БЮДЖЕТ</p>
				<p class="cost"><span>37,300.00 <b>₽</b></span><del>51,000.00 ₽</del></p>
				<h4>НИИ урологии имени Н.А. Лопаткина</h4>
				<p>105425, г. Москва, ул. 3-я Парковая, дом 51<br>
					<span class="phone">8 (499) 367-52-72</span><br>
					<span class="phone">8 (499) 367-84-18</span></p>
				<p><br>Стандартная трансректальная биопсия из 12-14 точек под ультразвуковым контролем, размещение в 2-3 местной палате, анестезия на выбор пациента.</p>
				<a href="#" class="but">Подробнее</a>
			</div>
			<div class="product_page_one">
				<p><img src="/img/clin-ico-1.png" alt=""></p><h3>Комплексная диагностика мужского здоровья</h3>
				<h4>НИИ им. Н.А. Лопаткина</h4>
				<p>Диагностика – это процесс установления диагноза, то есть заключения о сущности болезни и состоянии пациента, выраженное в принятой медицинской терминологии. Диагностика основывается на всестороннем и систематическом изучении ... </p>
				<a href="#" class="but">Подробнее</a>
			</div>
			<div class="product_page_one">
				<p><img src="/img/clin-ico-2.png" alt=""></p><h3>Комплексная диагностика мужского здоровья</h3>
				<h4>ФГБУ КБ №1 (Волынская больница)</h4>
				<p>Диагностика – это процесс установления диагноза, то есть заключения о сущности болезни и состоянии пациента, выраженное в принятой медицинской терминологии. Диагностика основывается на всестороннем и систематическом изучении ... </p>
				<a href="#" class="but">Подробнее</a>
			</div>
			<div class="product_page_one">
				<p class="icon"><img src="/img/icon-7.png" alt=""></p>
				<h3>ЛЕЧЕНИЕ АДЕНОМЫ ПРОСТАТЫ</h3>
				<p class="big grey">СТАНДАРТ</p>
				<p class="cost"><span>57,300.00 <b>₽</b></span><del>71,000.00 ₽</del></p>
				<h4>НИИ урологии имени Н.А. Лопаткина</h4>
				<p>105425, г. Москва, ул. 3-я Парковая, дом 51<br>
				8 (499) 367-52-72<br>
				8 (499) 367-84-18</p>
				<p>Стандартная трансректальная биопсия из 12-14 точек под ультразвуковым контролем, размещение в 2-3 местной палате, анестезия на выбор пациента.</p>
				<a href="#" class="but">Подробнее</a>
			</div>
			<div class="product_page_one">
				<p><img src="/img/img-1.jpg" alt=""></p>
				<h3>Загрядский<br>Евгений Алексеевич</h3>
				<p>ПРОКТОЛОГ, ХИРУРГ</p>
				<p class="cost">Первичный прием <span>2,300.00 <b>₽</b></span></p>
				<p>Биопсия предстательной железы – диагностическая процедура, позволяющая в полной мере оценить процессы, происходящие в предстательной железе.</p>
				<a href="#" class="but">Подробнее</a>
			</div>
		</div>
		 <!-- /right -->

        </div>
      </section>
	  <!-- /column2 -->

<?php return ?>

<?php foreach($productList as $item): ?>

<?= $item['type']['title'] ?><br/>
<?= $item['title'] ?><br/>
<?= $item['price'] ?><br/>
<?= $item['price_discount'] ?><br/><br/>

<b><?= $item['type']['title'] ?></b><br/>
<?= $item['type']['body'] ?><br/><br/>

<!--
<b>Точное наименование продукта</b><br/>
<?//= $item['type']['title_full'] ?><br/><br/>
-->

<b>План лечения</b><br/>
<?= $item['intro'] ?><br/><br/>

<b><?= $item['organization']['title'] ?></b><br/>
<?= $item['organization']['body'] ?><br/>



<br/><br/><br/>

<?php endforeach ?>
