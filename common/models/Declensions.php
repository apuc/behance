<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 15.11.2018
 * Time: 14:32
 */

namespace common\models;


class Declensions {
	
	static $day = 'день';
	static $days = 'дня';
	
	public static function CheckDay($d){
//		preg_match_all('!\d+!', $str, $matches);
		if ($d%10 >= 5) {
			return self::$days;
		} else {
			return self::$day;
		}
	}
}