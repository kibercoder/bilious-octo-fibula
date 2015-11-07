<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

use yii\bootstrap\Tabs;

$this->title = 'Калькулятор набора услуг';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="row site-about">

  <div class="col-md-7" style="text-align: center;">
    
    <div class="col-xs-5" style="padding-left: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Сумма</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-3">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Количество вариантов</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-4" style="padding-right: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Лучшее предложение</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    
    <div class="col-xs-3" style="padding-left: 0;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Исследования</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-3" style="margin: 0 25px;">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Процедуры</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <div class="col-xs-3">
      <div class="panel panel-default">
          <table class="table" style="height: 100px;">
            <tbody>
            <tr>
              <td style="vertical-align: middle;">Программы</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
    
    <form style="float: left; width: 100%;" action="#" method="post">
      <fieldset>
        <table width="100%" style="text-align: left;">
          <tbody>
                        <tr>
              <td><label><input name="mrt" type="checkbox" />&nbsp;МРТ</label></td>
              <td><label><input name="massage" type="checkbox" />&nbsp;Массаж</label></td>
              <td><label><input name="prep_for_labor" type="checkbox" />&nbsp;Подготовка к родам</label></td>
            </tr>
                        <tr>
              <td><label><input name="ket" type="checkbox" />&nbsp;КЭТ</label></td>
              <td><label><input name="clyster" type="checkbox" />&nbsp;Клистир</label></td>
              <td><label><input name="urinology" type="checkbox" />&nbsp;Урология</label></td>
            </tr>
                        <tr>
              <td><label><input name="roentgen" type="checkbox" />&nbsp;Рентген</label></td>
              <td><label><input name="botox" type="checkbox" />&nbsp;Ботокс</label></td>
              <td><label><input name="joints" type="checkbox" />&nbsp;Суставы</label></td>
            </tr>
                        <tr>
              <td><label><input name="uzi" type="checkbox" />&nbsp;УЗИ</label></td>
              <td><label><input name="psychotherapy" type="checkbox" />&nbsp;Сеанс психотерапии</label></td>
              <td><label><input name="labor" type="checkbox" />&nbsp;Роды</label></td>
            </tr>
                        <tr>
              <td><label><input name="issl1" type="checkbox" />&nbsp;Иссл1</label></td>
              <td><label><input name="procedure1" type="checkbox" />&nbsp;Процедура1</label></td>
              <td><label><input name="program1" type="checkbox" />&nbsp;Программа1</label></td>
            </tr>
                                    <tr>
              <td><label><input name="issl2" type="checkbox" />&nbsp;Иссл2</label></td>
              <td><label><input name="procedure2" type="checkbox" />&nbsp;Процедура2</label></td>
              <td><label><input name="program2" type="checkbox" />&nbsp;Программа2</label></td>
            </tr>
                                    <tr>
              <td><label><input name="issl3" type="checkbox" />&nbsp;Иссл3</label></td>
              <td><label><input name="procedure3" type="checkbox" />&nbsp;Процедура3</label></td>
              <td><label><input name="program3" type="checkbox" />&nbsp;Программа3</label></td>
            </tr>
                                    <tr>
              <td><label><input name="issl4" type="checkbox" />&nbsp;Иссл4</label></td>
              <td><label><input name="procedure4" type="checkbox" />&nbsp;Процедура4</label></td>
              <td><label><input name="program4" type="checkbox" />&nbsp;Программа4</label></td>
            </tr>
                                    <tr>
              <td><label><input name="issl5" type="checkbox" />&nbsp;Иссл5</label></td>
              <td><label><input name="procedure5" type="checkbox" />&nbsp;Процедура5</label></td>
              <td><label><input name="program5" type="checkbox" />&nbsp;Программа5</label></td>
            </tr>
                                    <tr>
              <td><label><input name="issl6" type="checkbox" />&nbsp;Иссл6</label></td>
              <td><label><input name="procedure6" type="checkbox" />&nbsp;Процедура6</label></td>
              <td><label><input name="program6" type="checkbox" />&nbsp;Программа6</label></td>
            </tr>
        
          </tbody>
        </table>
      </fieldset>
    </form>

  </div>
  

    <?php echo $this->render('_reviewsAndNews'); ?>

  
</div>

