<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>

<div class="password-reset">
    <p>Здравствуйте 
      <?= Html::encode($user->last_name) ?>
      <?= Html::encode($user->first_name) ?>
      <?= Html::encode($user->middle_name) ?>
    </p>

    <p>Ваш логин: <?= Html::encode($user->username) ?></p>
    <p>Ваш пароль: <?= Html::encode($user->password) ?></p>
    <p>
        При желании вы всегда можете сменить ваш пароль
    </p>

</div>

