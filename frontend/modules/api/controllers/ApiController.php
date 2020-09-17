<?php


namespace frontend\modules\api\controllers;


use Yii;

class ApiController
{
    public static function apiRequest(string $url, array $args = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        if ($args !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
    }

    public static function sendTelegramMessage(array $args)
    {
        self::apiRequest(Yii::$app->params['telegram_api_url'], $args);
    }
}