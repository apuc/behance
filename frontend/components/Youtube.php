<?php

namespace frontend\components;

use common\classes\Debug;
use Google_Client;
use Google_Service_YouTube;
use yii\base\Component;

class Youtube extends Component
{
    private $apiKey = 'AIzaSyBBmSdK4ycKsr8ZUM_UYf6ZYt88dUDJLq0';

    public function getDuration($id)
    {
        $json_result = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=" . $id . "&key=" . $this->apiKey);
        $obj = json_decode($json_result);
        $duration = $obj->items[0]->contentDetails->duration;

        $second = 0;
        preg_match("/[0-9]{1,2}[H]/", $duration, $hours);

        if (!empty($hours)) {
            $hours = substr($hours[0], 0, -1);
            $second += $hours * 60 * 60;
        }
        preg_match("/[0-9]{1,2}[M]/", $duration, $minutes);
        if (!empty($minutes)) {
            $minutes = substr($minutes[0], 0, -1);
            $second += $minutes * 60;
        }
        preg_match("/[0-9]{1,2}[S]/", $duration, $sec);
        if (!empty($sec)) {
            $sec = substr($sec[0], 0, -1);
            $second += $sec;
        }

        return $second;
    }

    public function getId($url)
    {
        preg_match("/[^v=]*$/", $url, $new_id);

        return $new_id[0];
    }
}