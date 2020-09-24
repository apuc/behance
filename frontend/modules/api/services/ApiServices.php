<?php

namespace frontend\modules\api\services;

class ApiServices
{
    private $url;

    /**
     * ApiServices constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param array|null $args
     */
    public function apiRequest(array $args = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        if ($args !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}