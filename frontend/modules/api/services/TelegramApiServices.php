<?php

namespace frontend\modules\api\services;


class TelegramApiServices extends ApiServices
{
    /**
     * @param string $siteName
     * @param string $text
     */
    public function sendTelegramMessage(string $siteName, string $text)
    {
        $this->apiRequest(['site' => $siteName, 'text' => $text]);
    }
}