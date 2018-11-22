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
        'css/style.css',
         '/css/font-awesome.css'
	];

	public $js = [
		'node_modules/material-components-web/dist/material-components-web.min.js',
        'js/cabinet.js',
		'js/misc.js',
		'js/material.js',
		'js/dashboard.js',
	];

	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}