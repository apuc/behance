<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 25.10.18
 * Time: 15:35
 */

namespace common\behance\traits;



use common\behance\Config;
use common\behance\lib\UserAgentArray;


trait CommonTrait
{
    public function behanceApiRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        return json_decode($res);
    }

    protected function getProxy()
    {

    }

    protected function getUserAgent()
    {
        return Config::get()['userAgentDriver']::getRandom();
    }
}