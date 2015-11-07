<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- content -->
<section class="block content">
  <div class="block-container">
	
  	<!-- left -->
  	<div class="left" style="width:720px;">
    	<p><img src="img/cont.jpg" alt="" /></p>
    	
    	<h1>
        НИИ УРОЛОГИИ И ИНТЕРВЕНЦИОННОЙ РАДИОЛОГИИ имени Н.А. Лопаткина 
        Филиал ФГБУ НМИРЦ Минздрава России
      </h1>
    
      <p>
        НИИ Урологии – современное, хорошо оснащенное учреждение с персоналом 
        высочайшей квалификации (здесь нужна верификация со стороны НИИ). 
        Традиции качества были заложены в период основания института – 1979 году, 
        на базе ведущей научной школы в области урологии - академика РАМН, профессора 
        Николая Алексеевича Лопаткина. Предлагаемая услуга является профильной для 
        НИИ Урологии, это значит, что основные усилия НИИ Урологии сконцентрированы 
        на создание условий для наилучшего решения урологических проблем со здоровьем.
      </p>
      <p>
        В НИИ урологии функционируют 10 научных отделов, 13 клинических отделений. 
        Кадровый научный потенциал НИИ урологии составляют более 100 научных сотрудников, 
        при этом 30 из них имеют степень доктора медицинских наук, 50 – кандидата медицинских наук.
      </p>
      <p>
        НИИ урологии оснащен новейшим медицинским оборудованием, позволяющим коллективу 
        высококвалифицированных специалистов оказывать помощь мирового уровня самым тяжелым 
        категориям больных. Так, радиоизотопная лаборатория НИИ урологии – одна из трех 
        существующих в Москве, и, что важно отметить, единственная размещенная в урологическом 
        центре. В отделении рентгенологии и ангиографии есть возможность выполнить КТ и МРТ, 
        приобретены как стационарные, так и подвижные рентгеновские аппараты, что позволяет 
        выполнять экстренные исследования в операционных, в урологических отделениях, в реанимации. 
        УЗИ проводятся высококвалифицированными специалистами на современных ультразвуковых 
        диагностических аппаратах экспертного класса «Esaote» и «Voluson 730» с применением 
        наружных и полостных мультичастотных датчиков с применением всех современных методик 
        исследования, в том числе допплерографию. Объединенная клинико-диагностическая 
        лаборатория с экспресс-лабораторией и группой обеспечения иммунологического типирования 
        обеспечивает возможность выполнить широкий спектр биохимических исследований, включая 
        выявление метаболических факторов риска мочекаменной болезни, исследование химического 
        состава мочевых камней, гематологические исследования, изосерологические, цитологические, 
        общеклинические исследования, исследование гемостаза, онкомаркеров, 
        и оценка состояния иммунного статуса.
      </p>
  	</div>
  	 <!-- /left -->
  	 <!-- right -->
  	<div class="right">
    	<p><img src="img/maps.jpg" alt="" /></p>
    	<img src="img/point-ico.png" alt="" />
    	<p>05425, Москва, ул. 3-я Парковая, 51</p>
    	<br /><br />
      <img src="img/m-ico.png" alt="" />
      <p>Щелковская</p>
      <br /><br />
      <img src="img/phone-ico.png" alt="" />
      <p>
        8 (495) 367-21-17 (справочная)<br />
        8 (495) 367-64-64 (справочная)<br />
        8 (495) 165-45-38 (поликлиника)<br />
        8 (495) 367-19-65 (поликлиника)<br />
        8 (495) 165-30-39 (поликлиника)<br />
        8 (495) 367-21-17 (платные услуги)
      </p>
  	</div>
  	 <!-- /right -->
	 
  </div>
</section>
<!-- /content -->
  
  
  
<!-- block1 -->
<section class="block block4">
  <div class="block-container">
  
    <h1>НАШИ ПРОДУКТЫ</h1>
    <div class="slider multiple-items3">
    
      <?php foreach($productList as $product): ?>
      <div>
        <h3 class="icon-1"><?=$product['title']?></h3>
        <p>
          <?=strip_tags($product['body'])?>
        </p>
        <a href="#" class="more">Заказать</a>
      </div>
      <?php endforeach; ?>
  
    </div>

  </div>
</section>
<!-- /block1 -->


<!-- block2 -->
<section class="block">
  <div class="block-container">

    <h1>НАШИ КЛИНИКИ</h1>
    <div class="slider multiple-items3">
    
      <?php foreach($orgList as $org): ?>
      <div>
        <h3><?=$org['title']?></h3>
        <p>
          <?=strip_tags($org['body'])?>
          <br />
          <?=$org['address']?>
          <br />
          <?= $org['phone'] ? $org['phone'].'<br />' : ''; ?>
          <?= $org['phone2'] ? $org['phone2'] : ''; ?>
        </p>
        <a href="#" class="more">Подробнее</a>
      </div>
      <?php endforeach;?>
    
    </div>

</div>
</section>
<!-- /block2 -->

<?return;?>

<div class="row site-about">

<div class="site-contact col-md-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'fieldConfig' => [
                    //'template' => "{label}\n\n{input}\n{hint}\n{error}\n",

                ]
            ]); ?>

                <?= $form->field($model, 'name'); ?>
                <?//= $form->field($model, 'name')->label(false); ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject', ['labelOptions'=> ['label' =>'Тема обращения']]) ?>
                <?= $form->field($model, 'body', ['labelOptions'=> ['label' =>'Опишите суть обращения, указав дату, время, страницу на сайте, а также максимально подробно другие детали']])->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'captchaAction' => 'feedback/default/captcha',
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

</div>