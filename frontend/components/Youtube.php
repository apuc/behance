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
        Debug::prn($duration);
        $time = [];
        $regular = '[0-9][H]';
//        $hours = preg_replace("/[0-9][H]/", '', $duration);
//        Debug::prn($hours);
        $minutes = preg_match("/[0-9][M]/",  '',$duration);
        Debug::dd($minutes);
        $hours = strstr($duration, 'H', true);
        $minutes = strstr($duration, 'M', true);
        $second = strstr($duration, 'S', true);
        Debug::prn($hours);
        Debug::prn($minutes);
        Debug::dd($second);
        preg_match_all('!\d+!', $duration, $time);
        if (strpos($duration, 'H') !== false) {
            $second += $time[0][0] * 60 * 60;
        }

        if (strpos($duration, 'M') !== false) {
            if (strpos($duration, 'H') !== false) {
                $second += $time[0][1] * 60;
            } else {
                $second += $time[0][0] * 60;
            }

        }

        if (strpos($duration, 'S') !== false) {
            switch (count($time)) {
                case 1:
                    $second += $time[0][0];
                    break;
                case 2:
                    $second += $time[0][1];
                    break;
                case 3:
                    $second += $time[0][2];
                    break;
            }
        }
        Debug::prn($duration);
        Debug::prn($second);
        Debug::dd($time);
        if (!empty($hours[0])) {
            $time += $hours[0][1] * 60 * 60;
        }
//        array_push($time, $matches * 60 * 60);
        $minute = stristr($duration, 'M', true);
        preg_match_all('!\d+!', $minute, $minute);
//        Debug::dd($minute);
        if (!empty($minute[0])) {
            $time += $minute[0][0] * 60;
        }
//        array_push($time, $minute * 60);
        $second = $minute = stristr($duration, 'S', true);
        Debug::dd($second);
        preg_match_all('!\d+!', $second, $second);
        array_push($time, $second);

        preg_match_all('!\d+!', $duration, $test);
        Debug::prn($duration);
        Debug::prn($test);
        Debug::dd($time);

//        return $duration;
    }
}