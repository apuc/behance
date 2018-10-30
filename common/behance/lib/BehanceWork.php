<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 25.10.18
 * Time: 15:34
 */

namespace common\behance\lib;


use common\behance\traits\CommonTrait;
use common\behance\traits\LikeTrait;
use common\behance\traits\ViewTrait;

class BehanceWork
{
    use LikeTrait,ViewTrait{
        ViewTrait::getProxy insteadof LikeTrait;
        ViewTrait::getUserAgent insteadof LikeTrait;
        ViewTrait::behanceApiRequest insteadof LikeTrait;
    }

    public $behanceId;
    public $url;
    public $name;
    public $image;



    public function __construct($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->accountId = (isset($data['account_id'])) ? $data['account_id'] : null;
        $this->behanceId = (isset($data['behance_id'])) ? $data['behance_id'] : null;
        $this->url = (isset($data['url'])) ? $data['url'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->image = (isset($data['image'])) ? $data['image'] : null;
    }



    public function like($count = 1)
    {
        $this->_like_($count, $this->behanceId);
    }



    public function view($count = 1)
    {
        $this->_view_($count, $this->url);
    }

}