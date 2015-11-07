<?php

use kartik\datecontrol\Module;

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [

        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['46.0.24.164', '109.194.67.22', '78.25.121.73', '92.55.5.232', '5.164.159.91', '46.0.141.123'],  //allowing ip's
            'generators' => [
                'upmc-crud' => [
                    'class' => 'common\generators\crud\Generator',
                ],
                'upmc-model' => [
                    'class' => 'common\generators\model\Generator',
                ],
            ],
        ],

       'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],

        'gridview'=> [
            'class'=>'\kartik\grid\Module',
            // other module settings
        ],

    ],

    'controllerMap' => [
            'elfinder' => [
                'class' => 'mihaildev\elfinder\PathController',
                'access' => ['@'],
                'root' => [
                    'baseUrl'=> '/uploads',
                    'basePath'=>'@webroot/../uploads',
                    'path' => '',
                    'name' => 'Files'
                ]
            ]
        ],

    'components' => [

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/access/login'],
        ],

        'session' => [
            'name' => 'PHPSESSIDADM',
            'class'=>'yii\web\CacheSession',
            'cache'=>'cache',
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'timeFormat' => 'php:H:i:s',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'user/access/error',
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'q8553366Va1R7PfGwC_k9oUsJuU0GGsq',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'user/user/index',
                '/login' => 'user/access/login',
                //'<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                //'<_c:[\w\-]+>' => '<_c>/index',
                //'<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
            ],
        ]
    ],
    'params' => $params,
];

if (!YII_ENV_TEST) {

    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    //$config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
