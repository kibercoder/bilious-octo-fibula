<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{


    //public $basePath = '@webroot';
    //public $baseUrl = '@web';

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $sourcePath = '@backend/assets';

    public $css = [
        'app/css/app.css',
        'redactor/sup/sup.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'
    ];

    public $js = [
        'redactor/sup/sup.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
