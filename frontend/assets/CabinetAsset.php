<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 03.09.2018
 * Time: 15:38
 */

namespace frontend\assets;

class CabinetAsset extends FrontAsset
{
	public $css = [
        'css/style.css',
		//'css/materialdesignicons.min.css',
       'css/font-awesome.min.css'

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