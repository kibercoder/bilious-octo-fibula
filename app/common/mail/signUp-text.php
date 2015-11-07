<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
  Здравствуйте 
  <?= $user->last_name ?>
  <?= $user->first_name ?>
  <?= $user->middle_name ?>

  Ваш логин: <?= $user->username ?>
  Ваш пароль: <?= $user->password ?>
  
  При желании вы всегда можете сменить ваш пароль