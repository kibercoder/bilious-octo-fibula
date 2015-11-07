<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- column2 -->
<section class="block column2">
  <div class="block-container">

      <!-- column-left -->
      <div class="column-left">
          <h4>добрый день!</h4>
          <br />
          <h4>ваш персональный номер в нашей системе #12345678</h4>
          <p><?=$model->last_name?>&nbsp;<?=$model->first_name?>&nbsp;<?=$model->middle_name?></p>
          
          <h4>mail</h4>
          <p><?=$model->email?></p>
          
          <h4>телефон</h4>
          <p><?=$model->phone?></p>
          <br /><br /><br />	
          <p>
          
            <a href="?edit=1" class="but">Редактировать</a>
            &nbsp;&nbsp;&nbsp;
            <a class="but" href="<?=Url::toRoute('/user/access/logout')?>" data-method="post">
                  Выйти
            </a>
          </p>
          
      </div>
      <!-- /column-left -->
      <!-- column-right -->
      <div class="column-right">
        <p></p>
      </div>
      <!-- /column-right -->

  </div>
</section>
<!-- /column2 -->

<?= $this->render('list_oders', ['model' => $model, 'orders' => $orders]) ?>