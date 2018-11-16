<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 25.10.18
 * Time: 15:34
 */

namespace common\behance\lib;


use common\behance\traits\CommonTrait;
use common\behance\interfaces\WorkInterface;

class BehanceWork implements  WorkInterface
{
    use CommonTrait;

    public $behanceId;
    public $url;
    public $name;
    public $image;
    public $startLikes;
    public $startViews;


    /**
     * BehanceWork constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->behanceId = (isset($data['behance_id'])) ? $data['behance_id'] : null;
        $this->url = (isset($data['url'])) ? $data['url'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->image = (isset($data['image'])) ? $data['image'] : null;
        $this->startLikes = (isset($data['start_likes'])) ? $data['start_likes'] : null;
        $this->startViews =(isset($data['start_views'])) ? $data['start_views'] : null;
    }


    /**
     * @param $proxy
     * @param $userAgent
     * @return bool
     */
    public function likeOnce($proxy,$userAgent)
    {
       return $this->_like_($this->behanceId,$proxy,$userAgent);
    }


    /**
     * @param $proxy
     * @param $userAgent
     * @return bool
     */
    public function viewOnce($proxy,$userAgent)
    {
        return $this->_view_($this->url,$proxy,$userAgent);
    }

}