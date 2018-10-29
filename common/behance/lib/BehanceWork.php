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
use common\models\Queue;

class BehanceWork
{
    use LikeTrait,ViewTrait,CommonTrait;

    public $behanceId;
    public $url;
    public $name;
    public $image;
    public $count;



    public function __construct($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->accountId = (isset($data['account_id'])) ? $data['account_id'] : null;
        $this->behanceId = (isset($data['behance_id'])) ? $data['behance_id'] : null;
        $this->url = (isset($data['url'])) ? $data['url'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->image = (isset($data['image'])) ? $data['image'] : null;
        $this->count = Queue::find()->where(['id' => 1])->one() ?? 1;
    }



    public function like()
    {
        $this->_like_($this->behanceId, $this->count->likes_count);
    }



    public function view()
    {
        $this->_view_($this->url, $this->count->views_count);
    }

}