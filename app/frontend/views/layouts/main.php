<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\ProductCat;
use common\models\LoginForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$css = <<<CSS
.header .login a.logout {
    float: left;
    text-align: right;
    height: 50px;
    width: 62px;
    padding: 28px 60px 0 0;
    background: url(../img/enter-top.png) no-repeat 100% 100%;
    display: block;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
}

.header .login .show div {
    margin: 10px 0 0; display: block;
}

.login .show .btn-primary {
    color: #a52025;
    background: #fff;
    border: 0;
    overflow: visible;
    outline: 0;
    text-transform: uppercase;
    padding: 5px 10px;
    margin: 0 0 5px;
    border-radius: 14px;
    display: inline-block;
    cursor: pointer;
    float: right;
}

.login .show .btn-primary:hover {
    background: #a52025;
    color: #fff;
}

CSS;

$this->registerCss($css);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

    <!--[if IE]>
        <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrapper">
      <div class="wrapper-container">

      <header class="block header">
          <div class="block-container">
      		  <div class="logo"><a href="/"></a><p style="visibility:hidden">Как это работает?</p>
      		  <small>Крупнейший портал поиска программ лечения</small>
      		  </div>
      		  <div class="individ"><a href="/cat/16">индивидуальное сопровождение</a></div>
      		  <div class="search"><a href="/search"></a></div>
      		  <div class="phone">8 800 <b>856-72-57</b></div>
      		  <div class="phone-link"><a href="#">Заказать<br>звонок</a></div>
      		  <div class="login">
            <?php if (Yii::$app->user->isGuest) : ?>
              <a href="#" class="enter">Войти</a>
              <div class="show">
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/login']);
                      $model = new LoginForm();
                ?>

                    <?= $form->field($model, 'rememberMe', ['template' => "\n{input}\n"])
                              ->hiddenInput(['id' => 'loginform-rememberme', 'value' => 1]);?>

                    <?= $form->field($model, 'username', [
                        'template' => "\n{label}\n{input}\n",
                        'labelOptions'=> ['label' =>'Mail']
                    ])->textInput(array('placeholder' => 'my@mail.ru', 'id' => 'your_username')); ?>

                    <?= $form->field($model, 'password', [
                        'template' => "\n{label}\n{input}\n",
                        'labelOptions'=> ['label' =>'ПАРОЛЬ']
                    ])->passwordInput(array('placeholder' => 'Введите ваш пароль', 'id' => 'your_pass')); ?>

                    <div>
                        <?= Html::submitButton('Войти', [
                              'class' => 'btn btn-primary',
                              'name' => 'login-button',
                            ])
                        ?>

                        <a href="<?=Url::toRoute('/user/request-password-reset')?>" class="but">
                            Восстановить доступ
                        </a>
                    </div>
                    <div>
                      <p class="small">Вы еще не зарегистрированы?</p>
                		  <a href="<?=Url::toRoute('/user/signup')?>" class="but">Зарегистрироваться</a>
                      <b></b>
                    </div>
                <?php ActiveForm::end(); ?>
      		    </div>
            <?php else : ?>
              <a class="logout" style="padding-left: 12px;" href="<?=Url::toRoute('/user/profile')?>">
                  Профиль
              </a>

            <?php endif; ?>

      		  </div>
          </div>
      </header>

     <!-- main-menu -->
        <?php $headMenu = ProductCat::loadMenu(); ?>

        <section class="block main-menu">
          <div class="block-container">
            <ul>
              <?php foreach($headMenu as $id => $item): ?>
              <li id="<?=$item['data']['id']?>">

                  <a href="#"><?= $item['data']['title'] ?></a>
                  <div>
                    <?php foreach($item['list'] as $item2): ?>
                    <a href="<?= '/cat/' . $item2['id'] ?>"><?= $item2['title'] ?></a>
                    <?php endforeach ?>
                    <b></b>
                  </div>
              </li>
              <?php endforeach ?>
            </ul>
          </div>
        </section>
    <!-- /main-menu -->

    <!-- find -->
        <?php if( Yii::$app->controller->showSearchBlock ): ?>
        <?= $this->render('_search') ?>
        <?php endif ?>
    <!-- /find -->

    <?= $content ?>

    <footer class="block footer">
        <div class="block-container">
		      <div class="logo"><a href="/"></a>© 2015</div>
        		<nav class="nav">

        		<div class="tbl3">

        		  <div class="col">
            		<ul>
            		<li><a href="<?=Url::toRoute('page/default/about')?>">О проекте</a></li>
            		<li><a href="#">Как это работает?</a></li>
            		<li><a href="<?=Url::toRoute('feedback/default/feedback')?>">Контакты</a></li>
            		<li><a href="#">Cоглашение пользователя</a></li>
            		</ul>
          		</div>

          		<div class="col">
            		<a href="#">Женское здоровье</a>
            		<ul>
                	<li><a href="#">Паталогии шейки матки</a></li>
                	<li><a href="#">Женщина за 40</a></li>
                	<li><a href="#">Подбор контрацептивов</a></li>
                	<li><a href="#">Лечение заболеваний, передающихся половым путем</a></li>
                </ul>
        	     </div>
          		<div class="col">
            		<a href="#">Диагностика и консультирование</a>
            		<ul>
                	<li><a href="#">Чекапы и скрининги</a></li>
                	<li><a href="#">Лучевая диагностика (МРТ, КТ, УЗИ)</a></li>
                	<li><a href="#">Диагностика заболеваний</a></li>
                	<li><a href="#">Профосмотры</a></li>
                </ul>
            	</div>
        		</div>

        		<div class="tbl3">
          		<div class="col">
            		<ul>
                  <li><a href="#">Наши клиники</a></li>
              		<li><a href="#">Мой аккаунт</a></li>
                </ul>
          		</div>
          		<div class="col"><a href="#">Акушерство</a>
          		  <ul>
                  <li><a href="#">Прием родов</a></li>
                </ul>
          		</div>
        		  <div class="col"><a href="#">Политика конфиденциальности</a>
          		<ul>
                  <li><a href="#">Пользовательское соглашение</a></li>
              </ul>
  		        </div>
		        </div>

		      </nav>

    			<div class="phone">
            <p style="white-space: nowrap">8 800<b> 856-72-57</b></p>
          </div>
    			<div class="up">
            <a href="#" data-function="scrollTop"></a>
          </div>

        </div>
      </footer>

      </div>
    </div>

    <?php $this->endBody() ?>
  </body>
</html>

<?php $this->endPage() ?>
