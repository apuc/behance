<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.11.18
 * Time: 14:37
 */

namespace common\behance\repositories;
use common\models\Proxy;

class ProxyArtcraft
{
    public static function getRandom()
    {
        $proxy = file_get_contents('https://proxy.craft-group.xyz/one-proxy?type=HTTP');
        $proxy = json_decode($proxy);
        return "{$proxy->host}:{$proxy->port}";
    }
}