<?php

namespace frontend\components;

use common\classes\Debug;
use yii\base\Component;

class Youtube extends Component
{
    public static function getDuration($url)
    {
        $api_key1 = 'AIzaSyBBmSdK4ycKsr8ZUM_UYf6ZYt88dUDJLq0';
        $video_id = 'KPdnpRfpjXM';

        $json_result = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $video_id . "&key=" . $api_key1);
        Debug::dd($json_result);
        parse_str(parse_url($url, PHP_URL_QUERY), $arr);
        $video_id = $arr['v'];
        $data = @file_get_contents('http://gdata.youtube.com/feeds/api/videos/' . $video_id . '?v=2&alt=jsonc');
        Debug::dd($data);
        if (false === $data) {
            return false;
        }
        $obj = json_decode($data);
        Debug::dd($obj->data->duration);
        return $obj->data->duration;
    }
}