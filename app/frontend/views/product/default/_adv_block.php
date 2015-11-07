<?php

use common\models\Organization;

$css = <<<CSS
.tbl3 .col .wrap_image img {
  display: inline-block; max-width: 160px; max-height: 160px; height:expression(this.scrollHeight > 160? "160px" : "auto"); width:expression(this.scrollWidth > 160? "160px" : "auto");
  position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto;
}

.tbl3 .col .wrap_image {
  position: relative; overflow: hidden;
}

CSS;

$this->registerCss($css);

?>

<!-- look -->
  <section class="block look look-img">
    <div class="block-container">

      <h1>ВАС МОЖЕТ ЗАИНТЕРЕСОВАТЬ</h1>
      <div class="tbl3">
        <div class="col">
          <p class="icon wrap_image">
              <img src="<?= $randProduct[0]['type']['icon_image'] ? "{$randProduct[0]['type']['icon_image']}" : "/img/icon-2.png" ?>" />
          </p>
          <h3><?=$randProduct[0]['title']?></h3>
          <p class="big grey"><?=$randProduct[0]['type']['title']?></p>
          <p class="cost">
              <span><?=$randProduct[0]['price_discount_format']?>&nbsp;<b>₽</b></span>
              <del><?=$randProduct[0]['price_format']?>&nbsp;₽</del>
          </p>
          <h4><?=$randProduct[0]['organization']['title']?></h4>
          <p>
              <?=$randProduct[0]['organization']['address']?><br />
              <?php foreach((array)Organization::getPhones($randProduct[0]['organization']) as $phone):?>
                  <?=$phone?><br />
              <?php endforeach;?>
          </p>
          <p><?=$randProduct[0]['intro']?></p>
          <a href="/product/<?=$randProduct[0]['id']?>" class="but">Подробнее</a>
        </div>

        <div class="col">
          <p class="icon wrap_image">
            <img src="<?=$randOrg[0]['main_image']?>" alt="" />
          </p>
          <h3><?=$randOrg[0]['title']?></h3>
            <p><?=$randOrg[0]['intro']?></p>
              <?=$randOrg[0]['address']?><br />
              <?php foreach((array)Organization::getPhones($randOrg[0]) as $phone):?>
                  <?=$phone?><br />
              <?php endforeach;?>
            </p>
          <a href="/organization/7<?=$randOrg[0]['id']?>" class="but">Подробнее</a>
        </div>

        <div class="col">
          <p class="icon wrap_image"><img src="<?=$randSpec[0]['photo_image']?>" alt="" /></p>
          <h3>
              <?=$randSpec[0]['last_name']?><br />
              <?=$randSpec[0]['first_name']?>
              <?=$randSpec[0]['middle_name']?>
          </h3>
          
          <p>
              <?php foreach($randSpec[0]['specTypes'] as $spec): ?>
                  <?=$spec['title']?>&nbsp;
              <?php endforeach;?>
          </p>

          <p><?=$randSpec[0]['intro']?></p>
          <a href="/specialist/<?=$randSpec[0]['id']?>" class="but" tabindex="0">Подробнее</a>
        </div>


      </div>

    </div>
  </section>
<!-- /look -->
