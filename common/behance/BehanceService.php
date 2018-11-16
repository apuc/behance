<?php

namespace common\behance;

use common\behance\lib\BehanceAccount;
use common\behance\traits\RepoTrait;

class BehanceService
{
    use RepoTrait;

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
     * @param BehanceAccount $account
     * @return BehanceService
     */
    public static function create(BehanceAccount $account)
    {
        return new self($account);
    }


    /**
     * @return array
     * @throws lib\BehanceApiException
     */
    public function getWorks()
    {
        $this->account->getWorks();
        return $this->account->works;
    }



    /**
     * @param $account
     */
    public function importAccount($account)
    {
        $this->account->url = $account->url;
        $this->account->behanceId = $account->behance_id;
        $this->account->displayName = $account->display_name;
        $this->account->username = $account->username;
        $this->account->image = $account->image;
    }



    /**
     * @param $url
     * @return bool|BehanceAccount
     * @throws lib\BehanceApiException
     */
    public function getAccount($url)
    {
        if($this->account->getAccountFromUrl($url))
            return $this->account;

        return false;
    }



    /**
     * @param $workBehanceId
     * @return bool
     */
    public function standardScenario($workBehanceId)
    {
        $userAgent = $this->getRandomUserAgent();
        $proxy = $this->getRandomProxy();

        $accountViewSuccess = $this->account->view($proxy,$userAgent);
        $workViewSuccess = $this->account->viewWork($workBehanceId,$proxy,$userAgent);
        $workLikeSuccess =$this->account->likeWork($workBehanceId,$proxy,$userAgent);

        if($accountViewSuccess && $workViewSuccess && $workLikeSuccess)
        {
           return true;
        }

        return false;
    }


    /**
     * @param $workBehanceId
     * @return bool
     */
    public function onlyViewScenario($workBehanceId)
    {
        $userAgent = $this->getRandomUserAgent();
        $proxy = $this->getRandomProxy();

        $accountViewSuccess = $this->account->view($proxy,$userAgent);
        $workViewSuccess =$this->account->viewWork($workBehanceId,$proxy,$userAgent);

        if($accountViewSuccess && $workViewSuccess)
        {
            return true;
        }

        return false;
    }


    /**
     * @param $workBehanceId
     * @return bool
     */
    public function onlyLikeScenario($workBehanceId)
    {
        $userAgent = $this->getRandomUserAgent();
        $proxy = $this->getRandomProxy();

        $accountViewSuccess = $this->account->view($proxy,$userAgent);
        $workLikeSuccess = $this->account->likeWork($workBehanceId,$proxy,$userAgent);

        if($accountViewSuccess  && $workLikeSuccess)
        {
            return true;
        }

        return false;
    }

}