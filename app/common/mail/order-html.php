<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>

<div class="password-reset">
    <p>Здравствуйте 
      <?= Html::encode($user->last_name) ?>
      <?= Html::encode($user->first_name) ?>
      <?= Html::encode($user->middle_name) ?>
    </p>
    
    <p>
      Вы заказали у нас товар - <?=$product['title']?><br />
      Сумма заказа - <?=$product['price_discount_format']?><br />
      Дата - <?=date("Y-m-d H:i:s")?><br />
      Номар карты - <?=$post['card_number']?><br />
      Имя на карте - <?=$post['card_name']?><br />
    </p>
    
    <p>
        Узнать о ваших заказах вы сможете <a href="<?=Url::toRoute('user/profile');?>">в личном кабинете.</a>
    </p>

</div>

