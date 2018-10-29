<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 29.10.2018
 * Time: 13:53
 */

namespace common\models;


class Debug {
	public static function toDebug($data) {
		echo "<pre>";
			print_r($data);
		echo "</pre>";
		die();
	}
}