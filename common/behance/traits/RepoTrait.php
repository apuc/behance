<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 16.11.18
 * Time: 14:19
 */

namespace common\behance\traits;

use common\behance\Config;
use common\behance\lib\UserAgentArray;

trait RepoTrait
{
    public function getRandomProxy()
    {
        return Config::get()['proxyDriver']::getRandom();
    }


    /**
     * @return mixed
     */
    public function getRandomUserAgent()
    {

        return Config::get()['userAgentDriver']::getRandom();
    }
}