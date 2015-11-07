<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../composer/vendor/autoload.php');
require(__DIR__ . '/../composer/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../app/common/config/bootstrap.php');
require(__DIR__ . '/../app/frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../app/common/config/main.php'),
    require(__DIR__ . '/../app/frontend/config/main.php'),
    require(__DIR__ . '/../app/frontend/config/routing.php')
);

$application = new yii\web\Application($config);
$application->run();