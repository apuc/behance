<?php

namespace common\behance;

use common\behance\lib\BehanceAccount;

class BehanceService
{
    public $account;


    /**
     * BehanceService constructor.
     * @param BehanceAccount $account
     */
    public function __construct(BehanceAccount $account)
    {
        $this->account = $account;
    }


    /**
     * @param $workId
     * @return $this
     */
    public function standardScenario($workId)
    {
       // $this->account->view();
        $this->account->likeWork([['id'=>$workId,"likes"=>1]]);
       // $this->account->viewWork([['id'=>$workId,"views"=>1]]);
        return $this;
    }


    /**
     * returns works from account
     *
     * @return array
     */
    public function getWorks()
    {
        $this->account->getWorks();
        return $this->account->works;
    }


    /**
     * @param $url
     * @return bool|BehanceAccount
     */
    public function getAccount($url)
    {
        if($this->account->getAccountFromUrl($url))
           return $this->account;

           return false;
    }

    /**
     * @param array(['id'=>'behanceId','likes'=>likesCount],[...])
     */
    public function likeWork($data)
    {
        $this->account->likeWork($data);
    }



    /**
     * @param array(['id'=>'behanceId','views'=>viewsCount],[...])
     */
    public function viewWork($data)
    {
       $this->account->viewWork($data);
    }


    /**
     * @param BehanceAccount $account
     * @return BehanceService
     */
    public static function create(BehanceAccount $account)
    {
        return new self($account);
    }


}