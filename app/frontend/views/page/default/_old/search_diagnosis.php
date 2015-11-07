<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use yii\bootstrap\Tabs;

$this->title = 'диагноз МКБ, найдено результатов 1234';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row site-about">

  <div class="col-md-7">
  
    <?php $form = ActiveForm::begin([
      'id' => 'search-form',
      'fieldConfig' => [
          //'template' => "{label}\n\n{input}\n{hint}\n{error}\n",

      ]
  ]); ?>
      <div class="col-xs-12" style="padding-left: 0; padding-right: 0;">
        <div class="panel panel-default">
            <table class="table" style="height: 60px;">
              <tbody>
              <tr>
                <td style="vertical-align: middle;">
                    <input style="width: 100%;" type="text" name="search" />
                </td>
                <td style="vertical-align: middle; text-align: center;">
                    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
                </td>
              </tr>
              </tbody>
            </table>
        </div>
      </div>

    <?php ActiveForm::end(); ?>
  
  
  <div class="col-xs-12" style="padding-right: 0; padding-left: 0;">
      <div class="panel panel-default">
        <div class="panel-heading">Вы искали: <?= Html::encode($this->title) ?></div>
          <table class="table">
            <tbody>
            <tr>
              <th>Клиника</th>
              <th>Место</th>
              <th>Цены</th>
            </tr>
            <tr>
              <td><a href="#">Название клиники</a></td>
              <td>Адрес клиники</td>
              <td>3535.66</td>
            </tr>
            <tr>
              <td><a href="#">Название клиники</a></td>
              <td>Адрес клиники</td>
              <td>3535.66</td>
            </tr>
            <tr>
              <td><a href="#">Название клиники</a></td>
              <td>Адрес клиники</td>
              <td>3535.66</td>
            </tr>
          </tbody>   
        </table>
      </div>
    </div>

    

  </div>
  
  <div>
    <?php echo $this->render('_reviewsAndNews'); ?>
  </div>
  
</div>

