<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->params['project.name'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $menuItems = [];

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Войти', 'url' => ['user/access/login']];
            } else {

                $menuItems[] = ['label' => 'Пользователи', 'url' => ['user/user/index']];

                $menuItems[] = [
                     'label' => 'Специалисты' ,
                      'items' => [
                          ['label' => 'Специалисты', 'url' => ['/specialist/specialist/index']],
                          ['label' => 'Типы специалистов', 'url' => ['/specialist/specialist-type/index']],
                      ],
                ];

                $menuItems[] = [
                     'label' => 'Продукты' ,
                      'items' => [
                          ['label' => 'Продукты', 'url' => ['/product/product/index']],
                          ['label' => 'Типы продуктов', 'url' => ['/product/product-type/index']],
                          ['label' => 'Категории', 'url' => ['/product/product-cat/index']],
                          ['label' => 'Договора', 'url' => ['/product/agreement/index']],
                          ['label' => 'Диагнозы', 'url' => ['/product/diagnos/index']],
                      ],
                ];
                
                $menuItems[] = ['label' => 'Заказы', 'url' => ['/order/order/index']];
                
                
                /*
                $menuItems[] = [
                     'label' => 'Услуги' ,
                      'items' => [
                          ['label' => 'Услуги', 'url' => ['/product/service/index']],
                          ['label' => 'Типы услуг', 'url' => ['/product/service-type/index']],
                          ['label' => 'Связи', 'url' => ['/product/service-product/index']]

                      ],
                ];
                */

                $menuItems[] = ['label' => 'Клиники', 'url' => ['/organization/organization/index']];
                
                $menuItems[] = ['label' => 'Отзывы', 'url' => ['/reviews/recommend/index']];

                //$menuItems[] = ['label' => 'Записи', 'url' => ['post/post/index']];
                //$menuItems[] = ['label' => 'Содержание', 'url' => ['rc/content/index']];

                $menuItems[] = [
                     'label' => Html::encode(Yii::$app->user->identity->username) ,
                      'items' => [
                          ['label' => 'Профиль',
                          'url' => Yii::$app->urlManager->createUrl(['/user/user/update', 'id' => Yii::$app->user->identity->id])],
                          '<li class="divider"></li>',
                          ['label' => 'Выйти', 'url' => ['/user/access/logout'], 'linkOptions' => ['data-method' => 'post']]
                      ],
                ];

                /*$menuItems[] = [
                    'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/admin/user/access/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];*/
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>


    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['project.name'] ?> <?= date('Y') ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>

    <script type="text/javascript">

/*$(document).ready(function(){

  $('button.btn-info').click(function(){

    $.post(
      "activateusers",
      {
          pk : $("#w3").yiiGridView("getSelectedRows")
      },
      function (data) {
          alert(data);

          //$.pjax.reload({container:"#w3"});
          return false;
    });

    return false;

  });

});*/


$(document).ready(function(){
  $('#test_link').click(function(){
    $(document).pjax('a', '#pjax-container');
    return false;
  });
});
</script>

</body>
</html>
<?php $this->endPage() ?>
