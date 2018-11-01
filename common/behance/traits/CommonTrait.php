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



    public function getRandomProxy()
    {
        return Config::get()['proxyDriver']::getRandom();
    }



    public function getRandomUserAgent()
    {

        return Config::get()['userAgentDriver']::getRandom();
    }



    public function _like_($behanceId,$likesCount = 1)
    {
        $successfulLikes = 0;

        for($i = 0; $i < $likesCount; $i++)
        {
            $proxy = $this->getRandomProxy();
            $userAgent = $this->getRandomUserAgent();
            $url = "https://www.behance.net/v2/projects/{$behanceId}/appreciate?client_id=BehanceWebSusi1";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_URL,$url);
            curl_setopt($curl,  CURLOPT_PROXY, $proxy);
            curl_setopt($curl,CURLOPT_USERAGENT, $userAgent);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_exec($curl);

            $error = curl_error($curl);
            curl_close($curl);

            if(empty($error))
            {
                $successfulLikes++;
            }
        }

        return $successfulLikes;
    }



    public function _view_($url,$viewsCount = 1)
    {

        $successfulViews = 0;

        for($i=0; $i<$viewsCount; $i++)
        {
            $proxy = $this->getRandomProxy();
            $userAgent = $this->getRandomUserAgent();

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_exec($curl);

            $error = curl_error($curl);
            curl_close($curl);

            if(empty($error))
            {
                $successfulViews++;
            }
        }

        return $successfulViews;
    }
}