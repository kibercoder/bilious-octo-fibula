<?php

return [
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [

                'GET /' => 'page/default/index',
                'GET /cat/<id>' => 'product/default/cat',
                'GET /search' => '/product/default/search',
                'GET /product/<id>' => 'product/default/product',
                //get и post нужны для того чтобы можно было отправлять данные методом Ajax
                'GET /product/<id>/buy' => 'product/default/product-buy',
                'POST /product/<id>/buy' => 'product/default/product-buy',

                'GET /specialists' => 'page/default/specialists',
                'GET /specialist/<id>' => 'page/default/specialist',

                'GET /organizations' => 'organization/default/organizations',
                'GET /organization/<id>' => 'organization/default/organization',

                //'GET /about' => 'page/default/about',
                //'GET /how' => 'page/default/how',

                //'GET /news/page/<page>' => 'post/post/index',
                //'GET /news' => 'post/post/index',
                //'GET /news/<id>' => 'post/post/post',

                //'/feedback' => 'feedback/default/feedback',
                //'GET /feedback/captcha' => 'feedback/default/captcha',

                '/login' => '/user/access/login',
                '/user/logout' => 'user/access/logout',
                '/user/request-password-reset' => 'user/access/request-password-reset',
                '/user/reset-password' => 'user/access/reset-password',

                '/user/signup' => 'user/signup/signup',
                '/user/profile' => 'user/profile/profile',


                //'/to_diagnose' => 'page/default/to_diagnose',
                //'/to_checkup' => 'page/default/to_checkup',
                //'/to_calculate' => 'page/default/to_calculate',
                //'/search_diagnosis' => 'page/default/search_diagnosis',
                //'/search_clinics' => 'organization/organization/search_clinics',
                //'/search_places' => 'page/default/search_places',

                '/how' => 'page/default/how',
                '/about' => 'page/default/about',

            ],
        ],
    ],

];
