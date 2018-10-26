<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 26.10.18
 * Time: 11:13
 */

namespace common\behance\traits;


trait LikeTrait
{

    public function _like_($likesCount,$behanceId)
    {
        $successfulLikes = 0;

        while($successfulLikes != $likesCount)
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
    }
}