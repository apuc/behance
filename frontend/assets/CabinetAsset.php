<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 03.09.2018
 * Time: 15:38
 */

namespace frontend\assets;
use yii\web\AssetBundle;

class CabinetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

	public $css = [
        'css/cabinet.css?2',
         '/css/font-awesome.css'
	];

	public $js = [
		'node_modules/material-components-web/dist/material-components-web.min.js',
        'js/cabinet.js?4',
		'js/misc.js',
		'js/material.js',
		'js/dashboard.js',
        'js/social-queue.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
	];

	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}