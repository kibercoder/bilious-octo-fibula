<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = strip_tags($model->title);
$this->metaTags[] = '<meta name="keywords" content="'.$model->keywords.'" />';
$this->metaTags[] = '<meta name="description" content="'.strip_tags($model->intro).'" />';
$this->params['breadcrumbs'][] = $this->title;

//$this->jsFiles[] = 'https://api-maps.yandex.ru/1.1/index.xml';

//$map_x = ($model->map_x) ? $model->map_x : '37.64';
//$map_y = ($model->map_y) ? $model->map_y : '55.76';
//$map_zoom = ($model->map_zoom) ? $model->map_zoom : '10';

$this->registerJsFile('https://api-maps.yandex.ru/1.1/index.xml');
$this->registerJs("

    // Создает обработчик события window.onLoad
    YMaps.jQuery(function () {

        // Создает экземпляр карты и привязывает его к созданному контейнеру
        var map = new YMaps.Map(YMaps.jQuery('#YMapsID')[0]);

        // искать все объекты с именем, но вывести только первый
        var geocoder = new YMaps.Geocoder('".$model->address."');

        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            if (this.length()) {
                //alert('Найдено :' + this.length());
                map.addOverlay(this.get(0));
                map.setCenter( this.get(0).getGeoPoint(), 16, YMaps.MapType.MAP);
            } else {
                alert('Ничего не найдено');
            }
        })

        YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, errorMessage) {
            alert('Произошла ошибка: ' + errorMessage)
        });
    })
");

?>

<!-- content -->
<section class="block content">
  <div class="block-container">

  	<!-- left -->
  	<div class="left" style="width:720px;">
    	<p><img src="<?=$model->main_image?>" alt="" /></p>

    	<h1><?=$model->title?></h1>

      <div>
        <?=$model->body?>
      </div>

  	</div>
  	 <!-- /left -->
  	 <!-- right -->
  	<div class="right">
    	<div id="YMapsID" style="width: 320px; height: 225px;">
        <!--<img src="/img/maps.jpg" alt="" />-->
      </div>
      <br />
    	<img src="/img/point-ico.png" alt="" />
    	<p><?=$model->address?></p>
    	<br /><br />

      <?php if($model->metro): ?>
      <img src="/img/m-ico.png" alt="" />
      <p><?=$model->metro?></p>
      <br /><br />
      <?php endif ?>

      <img src="/img/phone-ico.png" alt="" />
      <p>
      <?= $model->phone ? $model->phone.'<br />' : ''; ?>
      <?= $model->phone2 ? $model->phone2 : ''; ?>
      </p>
  	</div>
  	 <!-- /right -->

  </div>
</section>
<!-- /content -->


<!-- block1 -->
<section class="block block4">
  <div class="block-container">

    <h1>ПРОДУКТЫ КЛИНИКИ</h1>
    <div class="slider multiple-items3">

      <?php foreach($productList as $product): ?>
      <div>
        <h3 class="icon-1"><?=$product['type']['title']?></h3>
        <p>
          <?= $product['intro'] ?>
        </p>
        <a href="/product/<?= $product['id'] ?>" class="more">Заказать</a>
      </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>
<!-- /block1 -->


<!-- block2 -->
<section class="block">
  <div class="block-container">

    <h1>ДРУГИЕ КЛИНИКИ</h1>
    <div class="slider multiple-items3">

      <?php foreach($orgList as $org): ?>
      <div>
        <h3><?=$org['title']?></h3>
        <p>
          <?=strip_tags($org['intro'])?>
          <br />
          <?=$org['address']?>
          <br />
          <?= $org['phone'] ? $org['phone'].'<br />' : ''; ?>
          <?= $org['phone2'] ? $org['phone2'] : ''; ?>
        </p>
        <a href="/organization/<?=$org['id']?>" class="more">Подробнее</a>
      </div>
      <?php endforeach;?>

    </div>

</div>
</section>
<!-- /block2 -->
