<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.11.18
 * Time: 14:37
 */

namespace common\behance\repositories;
use common\models\Proxy;

class ProxyDbYii
{
    public static function getRandom()
    {
       $count = Proxy::find()->select('id')->count();
       $rand_id = rand(1,$count);
       $prpxy = Proxy::find()->asArray()->where('id='.$rand_id)->all();
       return $prpxy[0]['ip'];
    }
}