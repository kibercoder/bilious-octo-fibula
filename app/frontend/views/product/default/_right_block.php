<?php
	use common\models\Organization;
?>

<!-- right -->
<div class="right product_page">
  <h3 style="padding-bottom: 0;" class="our_rec">Мы рекомендуем</h3>

    <?php foreach($recommend as $product): ?>

    <div class="product_page_one">

      <p class="icon1">
        <img src="<?= $product['type']['icon_image'] ? "{$product['type']['icon_image']}" : "/img/icon-2.png" ?>" alt="" />
      </p>
      <h3><?=$product['type']['title']?></h3>
      <p class="big grey"><?=$product['title']?></p>
      <p class="cost">
          <span><?=$product['price_discount_format']?>&nbsp;<b>₽</b></span>
          <del><?=$product['price_format']?>&nbsp;₽</del>
      </p>
      <h4><?=$product['organization']['title']?></h4>
      <p>
          <?=$product['organization']['address']?><br />
          <?php foreach((array)Organization::getPhones($product['organization']) as $phone):?>
              <span class="phone"><?=$phone?></span><br />
          <?php endforeach;?>
      </p>
      <p>
          <?=$product['title']?>
      </p>
      <a href="/product/<?=$product['id']?>" class="but">Подробнее</a>
    </div>
    <?php endforeach;?>

</div>
 <!-- /right -->
