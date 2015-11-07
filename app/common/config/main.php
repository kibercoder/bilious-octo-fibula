<?php

$params = require(__DIR__ . '/../../common/config/params.php');

return [

    'vendorPath' => __DIR__ . '/../../../composer/vendor',

    'language' => 'ru-RU',
    //'sourceLanguage' => 'en-EN',

    'components' => [

        'request' => [
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-EN'
                    //'fileMap' => ['app' => 'app.php', 'app.auth' => 'auth.php']
                ],
            ],
        ],

        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached'=>true,
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 100,
                ],
            ],
        ],

        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            // Роли guest и user - есть роли по умолчанию
            'itemFile' => '@common/rbac/items.php',
            // Задаем правила присвоения роли юзеру
            'ruleFile' => '@common/rbac/rules.php',
            // Привязка
            //'assignmentFile' => '@common/rbac/assignment.php',
            'defaultRoles' => ['admin', 'moderator'],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.$params['db.host'].';dbname='.$params['db.name'],
            'username' => $params['db.user'],
            'password' => $params['db.pass'],
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ],

      ],

      'modules' => [

       'datecontrol' =>  [

            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                //kartik\datecontrol\Module::FORMAT_DATE => 'php:Y-m-d',
                kartik\datecontrol\Module::FORMAT_DATE => 'php:dd.mm.Y',
                kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i',
                //kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm:ss',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'php:Y-m-d 00:00:00', // saves as unix timestamp
                kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            //'displayTimezone' => 'Europe/Moscow',

            // set your timezone for date saved to db
            //'saveTimezone' => 'Europe/Moscow',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => false,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => [], // example
                kartik\datecontrol\Module::FORMAT_DATETIME => [], // setup if needed
                kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
            ],
        // other settings
        ]

    ],



];
