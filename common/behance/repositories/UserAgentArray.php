<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 29.10.18
 * Time: 16:20
 */

namespace common\behance\repositories;


class UserAgentArray
{
    public static $userAgents = [
        'Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27',
        'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
    ];

    public static function getRandom()
    {
        return  static::$userAgents[rand(0,count(static::$userAgents)-1)];
    }
}