<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <?php $this->head() ?>
    
    <!--[if IE]>
        <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">

        <?php
            Url::remember();

            if (Url::previous() != Url::toRoute('page/default/index')){
        
              NavBar::begin([
                  'brandLabel' => Yii::$app->params['project.name'],
                  'brandUrl' => Yii::$app->homeUrl,
                  'options' => [
                      'class' => 'navbar-inverse navbar-fixed-top',
                  ],
              ]);
              $menuItems = [
                  ['label' => 'О проекте', 'url' => ['/page/default/about']],
                  ['label' => 'Как это работает', 'url' => ['/page/default/how']],
                  ['label' => 'Контакты', 'url' => ['/feedback/default/feedback']],
                  //['label' => 'Главная', 'url' => ['/page/default/index']],
                  //['label' => 'Новости', 'url' => ['/post/post/index']],
              ];
              if (Yii::$app->user->isGuest) {
                
                  $menuItems[] = [
                      'label' => 'Регистрация',
                      'items' => [
                          ['label' => 'Войти', 'url' => ['/user/access/login'], 'linkOptions' => ['data-method' => 'post']],
                          '<li class="divider"></li>',
                          ['label' => 'Регистрация', 'url' => ['/user/signup/signup']]
                      ],
  
                  ];
  
              } else {
                  $menuItems[] = [
                      'label' => 'Профиль',
                      'url' => ['/user/profile/profile'],
                  ];
                  $menuItems[] = [
                      'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                      'url' => ['/user/access/logout'],
                      'linkOptions' => ['data-method' => 'post']
                  ];
              }
              echo Nav::widget([
                  'options' => ['class' => 'navbar-nav navbar-left'],
                  'items' => $menuItems,
              ]);
              NavBar::end();
            
            }
        ?>

        <div class="container">
  
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
  
          <?= Alert::widget() ?>
          <?= $content ?>
        
        </div>
    </div>

    <?php $this->endBody() ?>


    <footer class="block footer">
        <div class="block-container">
		
		<div class="logo"><a href="/"></a>© 2015</div>
		<nav class="nav">
		<ul>
		<li><a href="#">О проекте</a><a href="#">Как это работает?</a><a href="#">Контакты</a><a href="#">Карта сайта</a></li>
		<li><a href="#">Наши продукты</a><a href="#">Наши клиники</a><a href="#">Мой аккаунт</a></li>
		<li><a href="#">Политика конфиденциальности</a><a href="#">Пользовательское соглашение</a></li>
		</ul>
		</nav>
		<div class="search"><a href="#"></a></div>
			<div class="phone"><p>8 800<b> 856-72-57</b></p></div>
			<div class="up"><a href="#"></a></div>
		
        </div>
      </footer>
	  
      </div>
    </div>
  </body>
</html>

<?php $this->endPage() ?>