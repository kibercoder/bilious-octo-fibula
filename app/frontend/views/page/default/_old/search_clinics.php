<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use yii\bootstrap\Tabs;

$this->title = $search.', найдено результатов '.$pages->totalCount;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row site-about">

  <div class="col-md-7">
  
    <?php $form = ActiveForm::begin([
      'id' => 'search-form',
      'method' => 'get',
      'action' => '/search_clinics',
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
                    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
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
            <?php foreach ($main_organization as $organization): ?>
            <tr>
              <td><a href="/organization/<?=$organization->id?>"><?=$organization->title?></a></td>
              <td><?=$organization->address?></td>
              <td>3535.66</td>
            </tr>
            <?php endforeach ?>
          </tbody>   
        </table>
      </div>
    </div>

<?php
	echo LinkPager::widget([
    'pagination' => $pages,
    'lastPageLabel'=>'Конец',
    'firstPageLabel'=>'Начало',
    'prevPageLabel' => 'Назад',
    'nextPageLabel' => 'Вперёд',
]);
?>

  </div>
  
  <div>
    <?=$this->render('/page/default/_reviewsAndNews.php')?>
  </div>
  
</div>