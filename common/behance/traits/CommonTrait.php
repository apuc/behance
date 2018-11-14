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
use common\behance\lib\BehanceApiException;


trait CommonTrait
{
    /**
     * @param $url
     * @return mixed
     * @throws BehanceApiException
     */
    public function behanceApiRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($res);

        if($res->http_code == '404')
        {
            throw new BehanceApiException('User not found!',404);
        }

        if($res->http_code == '403')
        {
            throw new BehanceApiException('Bad token!',403);
        }

        return $res;
    }


    /**
     * @return mixed
     */
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


    /**
     * @param $behanceId
     * @param int $likesCount
     * @return int
     */
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


    /**
     * @param $url
     * @param int $viewsCount
     * @return int
     */
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