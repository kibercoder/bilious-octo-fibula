<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;

use common\models\ProductCat;
use common\models\Product;
use common\models\Organization;
use common\models\SpecialistHasType;


$this->title = 'Главная';
//$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
.slider .wrap_review img {
  display: inline-block; max-width: 160px; max-height: 160px; height:expression(this.scrollHeight > 160? "160px" : "auto"); width:expression(this.scrollWidth > 160? "160px" : "auto");
  position: absolute; right: 0; top: 0; bottom: 0; margin: auto;
}

.slider .wrap_review {
  position: relative;
}

CSS;

$this->registerCss($css);

?>

    <!-- slider-big -->
        <section class="block slider-bg">
          <div class="block-container">
      		  <div class="slider slider-big">
			  <div><img src="/img/topbanners1.jpg" alt=""></div>
              <div><img src="/img/topbanners2.jpg" alt=""></div>
            </div>
          </div>
        </section>
    <!-- /slider-big -->

    <!-- block1 -->
      <section class="block block1">
          <div class="block-container">

    		  <h1>ЛУЧШИЕ ПРЕДЛОЖЕНИЯ</h1>

      		<div class="slider multiple-items3">

            <?php foreach($productList as $product): ?>
              <div>
			  <p><img src="<?= $product['type']['icon_image'] ? "{$product['type']['icon_image']}" : "/img/icon-2.png" ?>" alt=""></p>
			  <!-- Жень в h3 бэка не будет, выводится картинкой img выше icon-1.png, это старый вариант я не успел это изменить -->
                <h3>
                    <?=$product['type']['title']?>
                </h3>
                <p class="big grey"><?= $product['title'] ?></p>
                <p class="cost">
                    <span><?=$product['price_discount_format']?> <b>₽</b></span>
                    <del><?=$product['price_format']?> ₽</del>
                </p>
                <h4><?=$product['organization']['title']?></h4>
                <p>
                    <?=$product['organization']['address']?><br />
                    <?php foreach( Organization::getPhones($product['organization']) as $phone): ?>
                        <?=$phone?><br />
                    <?php endforeach;?>
                </p>
                <p><?=$product['intro']?></p>
                <a href="/product/<?=$product['id']?>" class="but">Подробнее</a>
              </div>
            <?php endforeach; ?>

            </div>
        </div>
      </section>
    <!-- /block1 -->

	
	    <!-- ban1 -->
        <section class="block ban1">
            <div class="block-container">

    		    <h1>Сервис сопровождения и консультации</h1>
		  <h2>Мы готовы сопровождать и консультировать Вас<br> 
на всех стадиях на лечения и профилактики заболевания</h2>

    		  <div class="tbl4">
            <div class="col">
              <p class="h_98"><img src="img/ban-ico-1.png" alt=""></p>
              <p>индивидуальное <br/>сопровождение <br/>нашим менеджером <br/>и врачом на всех <br/>стадиях лечения</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-2.png" alt=""></p>
                <p>наличие свободных <br/>мест в выбранных <br/>госпиталях в удобное <br/>для Вас время</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-3.png" alt=""></p>
                <p>экстренный вызов <br/>скорой медицинской <br/>помощи и дальнейшее <br/>сопровождение</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-4.png" alt=""></p>
                <p>юридическое сопровождение и подготовка документов</p>
            </div>

          </div>
		  <p align="center"><a href="/cat/16" class="but1">Узнать о сервисе больше</a></p>
        </div>
    </section>
    <!-- /ban1 -->
	
	
	
    <!-- ban1
        <section class="block ban1">
            <div class="block-container">

    		    <h1>
             Сервис сопровождения и консультации
          </h1>
		  <h2>Мы готовы сопровождать и консультировать Вас<br/>на всех стадиях на лечения и профилактики заболевания</h2>

    		  <div class="tbl4">
            <div class="col">
              <p class="h_98"><img src="img/ban-ico-1.png" alt=""></p>
              <p>индивидуальное <br/>сопровождение <br/>нашим менеджером <br/>и врачом на всех <br/>стадиях лечения</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-2.png" alt=""></p>
                <p>наличие свободных <br/>мест в выбранных <br/>госпиталях в удобное <br/>для Вас время</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-3.png" alt=""></p>
                <p>экстренный вызов <br/>скорой медицинской <br/>помощи и дальнейшее <br/>сопровождение</p>
            </div>

            <div class="col">
				<p class="h_98"><img src="img/ban1-ico-4.png" alt=""></p>
                <p>юридическое сопровождение и подготовка документов</p>
            </div>

          </div>
		  <a href="/cat/16" class="ban1_link">Узнать о сервисе больше</a>
        </div>
    </section>
    /ban1 -->

    <!-- clinic -->
        <section class="block">
            <div class="block-container">

    		    <h1>НАШИ КЛИНИКИ</h1>

        		<div class="slider multiple-items3 clinic">

            <?php foreach($orgList as $org): ?>
              <div>
                <p><img src="<?= $org['icon_image'] ? $org['icon_image'] : '/img/clin-ico-1.png' ?>" alt="" /></p>
                <h3><?=$org['title']?></h3>
                <p>
                  <?= $org['intro'] ?>
                  <br />
                  <?=$org['address']?>
                  <br />
                  <?php foreach((array)Organization::getPhones($org['id']) as $phone): ?>
                        <?=$phone?><br />
                  <?php endforeach;?>
                </p>
                <a href="/organization/<?=$org['id']?>" class="but">Подробнее</a>
              </div>
              <?php endforeach;?>

            </div>
        </div>
      </section>
    <!-- /clinic -->

    <!-- ban2 -->
    <section class="block ban2">
        <div class="block-container">
          <p></p>
        </div>
    </section>
    <!-- /ban2 -->

    <!-- block -->
      <section class="block">
        <div class="block-container">
        		<p class="main-text">На нашем сайте размещена информация только о продуктах, клиниках и специалистах,<br />
        имеющих медицинские сертификаты и прошедших соответсвующую аккредитацию.</p>

        </div>
      </section>
    <!-- /block -->


	  <!-- ban6 -->
      <section class="block ban6">
        <div class="block-container">
		<h1>Запросите примерную оценку<br> 
стоимости Вашего лечения</h1>
          <p>Медицинские консультанты  помогут Вам найти ответ на любой вопрос.<br>
Сообщите нам, что Вас интересует, и мы свяжемся с Вами в кратчайшие сроки.</p>
<br>
<p><a href="#" class="but1">Отправить запрос на лечение</a></p>
        </div>
      </section>
    <!-- /ban6 -->


 	  <!-- programm -->
      <section class="block programm">
        <div class="block-container">
		      <h1>ПРОГРАММЫ ЛЕЧЕНИЯ</h1>

      				<div class="tbl3">
        <div class="col">
            <p><img src="img/prog-ico-1.png" alt="" style="padding:7px 0 0 0;"></p>
            <p>Что такое программы лечений? Это лучшие практики, собранные в виде готовых пакетов, которые мы готовы Вам предложить. Стандартизация в медицине – это современный подход, активно развивающийся как у нас, так и за рубежом. Стандартизация позволяет повысить качество, прозрачность, и дать возможность проводить контроль на всех стадиях одними из лучших специалистов страны.</p>
        </div>

        <div class="col">
            <p><img src="img/prog-ico-2.png" alt="" style="padding:8px 0 0 0;"></p><p>Кроме этого, использование стандартов, как хорошо известно, повышает производительность труда. Поэтому, покупая пакеты и программы лечений Вы гарантированно экономите Ваши средства.</p>
        </div>

        <div class="col">
            <p><img src="img/clin-ico-2.png" alt=""></p><p>Безусловно, не все случаи могут быть закрыты стандартами. Поэтому мы предлагаем сформировать или подобрать необходимую программу с помощью наших специалистов, которые порекомендуют Вам лучшие диагностические центры, либо помогут Вам самостоятельно подобрать диагностическую программу из списка представленных на нашем сайте.</p>
        </div>

      </div>

        </div>
      </section>
	  <!-- /programm -->


	 <!-- ban3 -->
      <section class="block ban3">
        <div class="block-container">
		      <p></p>
        </div>
      </section>
	  <!-- /ban3 -->

	  <!-- block1 -->
      <section class="block block1">
        <div class="block-container">

		      <h1>ЛУЧШИЕ СПЕЦИАЛИСТЫ</h1>

      		<div class="slider multiple-items3 spec">
                        
            <?php foreach($specList as $spec): 
                  $specId = Product::loadList('*',['specialist_id' => $spec['id']]);
            ?>

            <div>

                <p>
                <img src="<?=$spec['photo_image']?>" alt="" style="display: inline-block; max-width: 160px; max-height: 160px; height:expression(this.scrollHeight > 160? '160px' : 'auto'); width:expression(this.scrollWidth > 160? '160px' : 'auto');" />
                </p>
                <h3>
                  <?=$spec['last_name']?><br />
                  <?=$spec['first_name']?><br />
                  <?=$spec['middle_name']?>
                </h3>
                <p>
                  <?php foreach((array)SpecialistHasType::loadList('*', ['spec_id' => $spec['id']]) as $job): ?>
                    <?=$job['specType']['title']?>&nbsp;
                  <?php endforeach;?>
                </p>
                <p class="cost">
                    <?=$specId[0]['type']['title']?>&nbsp;
                    <span><?=Product::priceFormat($specId[0]['price_discount'])?>&nbsp;<b>₽</b></span>
                </p>
                <p><?=strip_tags($spec['intro'])?></p>
                <a href="/specialist/<?= $spec['id'] ?>" class="but">Подробнее</a>
            </div>

            <?php endforeach;?>

          </div>
        </div>
      </section>
	  <!-- /block1 -->

    <!-- ban4 -->
      <section class="block ban4">
        <div class="block-container">
		      <p></p>
        </div>
      </section>
	  <!-- /ban4 -->

	  <!-- comment -->
      <section class="block">
        <div class="block-container">

        		<h1>НАС РЕКОМЕНДУЮТ</h1>
        		<div class="slider multiple-items2 comment">

                <?php foreach($review_list as $review): ?>

                  <div class="wrap_review">
                    <img src="<?=$review['photo_image']?>" alt="<?=$review['name']?>" />
                    <p><?=strip_tags($review['intro'])?></p>
            	     <cite><?=$review['name']?></cite>
                </div>
                <?php endforeach;?>
                
          </div>

        </div>
      </section>
	  <!-- /comment -->
