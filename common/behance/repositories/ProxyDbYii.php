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
       $ids = Proxy::find()->select('id')->all();
       $rand_id = $ids[rand(1,count($ids)-1)]->id;
       $prpxy = Proxy::find()->asArray()->where('id='.$rand_id)->all();
       return $prpxy[0]['ip'];
    }
}