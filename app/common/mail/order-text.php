<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
  Здравствуйте 
  <?= $user->last_name ?>
  <?= $user->first_name ?>
  <?= $user->middle_name ?>

  Вы заказали у нас товар - <?=$product['title']?>
  Сумма заказа - <?=$product['price_discount_format']?>
  Дата - <?=date("Y-m-d H:i:s")?>
  Номар карты - <?=$post['card_number']?>
  Имя на карте - <?=$post['card_name']?>

  Узнать о ваших заказах вы сможете в личном кабинете.
