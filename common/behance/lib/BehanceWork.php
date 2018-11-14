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

class BehanceWork implements WorkInterface
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
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->accountId = (isset($data['account_id'])) ? $data['account_id'] : null;
        $this->behanceId = (isset($data['behance_id'])) ? $data['behance_id'] : null;
        $this->url = (isset($data['url'])) ? $data['url'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->image = (isset($data['image'])) ? $data['image'] : null;
        $this->startLikes = (isset($data['start_likes'])) ? $data['start_likes'] : null;
        $this->startViews =(isset($data['start_views'])) ? $data['start_views'] : null;
    }


    /**
     * @param int $count
     */
    public function like($count = 1)
    {
        $this->_like_($this->behanceId,$count);
    }


    /**
     * @param int $count
     */
    public function view($count = 1)
    {

        $this->_view_($this->url,$count);
    }

}