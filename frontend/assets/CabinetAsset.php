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


	];
	public $js = [
		'node_modules/material-components-web/dist/material-components-web.min.js',
		//'node_modules/jquery/dist/jquery.min.js',
		//'node_modules/chart.js/dist/Chart.min.js',
		//'node_modules/progressbar.js/dist/progressbar.min.js',
		'js/misc.js',
		'js/material.js',
		'js/dashboard.js',
	];

	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        ];

}