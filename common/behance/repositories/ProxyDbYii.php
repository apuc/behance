<?php

namespace common\behance\repositories;
use common\models\Proxy;

class ProxyDbYii
{
    public static function getRandom()
    {
       $ids = Proxy::find()->select('id')->all();
       $rand_id = $ids[rand(1,count($ids)-1)]->id;
       $proxy = Proxy::findOne($rand_id);
       return str_replace(array("\r","\n"),"",$proxy->ip);
    }
}