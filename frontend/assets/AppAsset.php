<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/slick.css',
        'css/bootstrap-grid.min.css',
        'css/slick.css',
        'css/site.css',
    ];
    public $js = [
        'js/slick.min.js',
        'js/wow.min.js',
        'js/script.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
