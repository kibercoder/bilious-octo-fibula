<?php
	use common\models\Organization;
?>

<!-- right -->
<div class="right product_page" style="padding-top: 0;">
  <h3 style="padding: 5px 0 40px;" class="our_rec">Мы рекомендуем</h3>

    <?php /* продукты */ ?>
    <?php foreach($productList as $product): ?>
    <div class="product_page_one">
      <?php if ($product['type']['icon_image']) {?>
            <h3 style="background: transparent url('<?=$product['type']['icon_image']?>') no-repeat scroll 0% 0%; padding-top: 67px;">
                <?=$product['type']['title']?>
            </h3>
      <?php }else{?>
            <h3 class="icon-1">
                <?=$product['type']['title']?>
            </h3>
      <?php }?>
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

    <?php /* организации */ ?>
    <?php foreach($orgList as $org):?>
      <div class="product_page_one">

      <?php if ($org['icon_image']) {?>
            <h3 style="background: transparent url('<?=$org['icon_image']?>') no-repeat scroll 0% 0%; padding-top: 80px;">
                <?=$org['title']?>
            </h3>
      <?php }else{?>
            <h3 class="icon-1">
                <?=$org['title']?>
            </h3>
      <?php }?>

        <p><?=$org['intro']?></p>
        <a href="/organization/<?=$org['id']?>" class="but">Подробнее</a>
      </div>
    <?php endforeach;?>

</div>
 <!-- /right -->
