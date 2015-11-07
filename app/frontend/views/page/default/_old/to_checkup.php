<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

use yii\bootstrap\Tabs;

$this->title = 'Регулярная проверка состояния здоровья (Checkup)';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="row site-about">

  <div class="col-md-7" style="text-align: center;">
    
    <div class="col-xs-4" style="padding-right: 0; padding-left: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle; text-align: center;">
                  <a style="white-space: nowrap; font-size: 12px;" href="#">Прохожу впервые</a>
              </td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-4">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle; text-align: center;">
                  <a style="white-space: nowrap; font-size: 12px;" href="#">Выбрать программу</a>
              </td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-4" style="padding-right: 0; padding-left: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle; text-align: center;">
                  <a style="white-space: nowrap; font-size: 12px;" href="#">Выбрать место</a>
              </td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-md-12" style="padding-right: 0; padding-left: 0;">
      <div class="panel panel-default">
        <div class="panel-heading">
            Варианты диагностического обследования - блок зависит от выбора варианта диагностики
        </div>
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Выбор бюджета</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    
    <div class="col-xs-7" style="padding-left: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Вариант по умолчанию</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-5" style="padding-right: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Спецпредложения от клиник</td>
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

