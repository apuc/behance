<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css?2',
        'css/AdminLTE.min.css',
        'css/font-awesome.min.css',
        'fonts/fontawesome-webfont.ttf'
    ];
    public $js = [
        'js/main.js?4',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'dmstr\web\AdminLteAsset',
    ];
}
