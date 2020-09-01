<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 30.11.18
 * Time: 14:22
 */

namespace common\classes;

class FreeCassa
{
    const SECRET_1 = '32rfcqqv';
    const SECRET_2 = '4ovny78u';
    const SHOP_ID = '107781';

    public static function generateSign($sum,$secret,$order_id)
    {
        $shop = self::SHOP_ID;
        return md5("{$shop}:{$sum}:{$secret}:{$order_id}");
    }
}