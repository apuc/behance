<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 25.10.18
 * Time: 15:34
 */

namespace common\behance\lib;



use common\behance\traits\CommonTrait;
use common\behance\Config;

use common\behance\interfaces\AccountInterface;
use yii\db\Exception;


class BehanceAccount implements AccountInterface
{
    use CommonTrait;

    public $behanceId;
    public $displayName;
    public $username;
    public $url;
    public $image;
    public $works = [];

    public $token;


    /**
     * BehanceAccount constructor.
     */
    public function __construct()
    {
        $this->token = Config::get()['apiKey'];
    }



    /**
     * @throws BehanceApiException
     */
    public function getWorks()
    {
        $this->works = [];
        $i = 1;

        while ($i > 0)
        {
            $url = "https://api.behance.net//v2/users/{$this->username}/projects?client_id={$this->token}&page={$i}";
            $res = $this->behanceApiRequest($url);

            $i++;

            if (empty($res->projects))
                break;

            foreach ($res->projects as $p) {
                $this->addWork($p);
            }
        }
    }


    /**
     * @param $work
     */
    public function addWork($work)
    {
        $data = array();
        $data['behance_id'] = (isset($work->behance_id)) ? $work->behance_id : $work->id;
        $data['name'] = $work->name;
        $data['url'] = $work->url;
        $data['start_likes'] = (isset($work->start_likes)) ? $work->start_likes : $work->stats->appreciations;
        $data['start_views'] = (isset($work->start_views)) ? $work->start_views : $work->stats->views;;
        $data['image'] = (isset($work->covers)) ? end($work->covers) : $work->image;


        $workObj = new BehanceWork($data);

        $this->works[$data['behance_id']] = $workObj;
    }


    /**
     * @param $workBehanceId
     * @param $proxy
     * @param $userAgent
     * @return bool
     */
    public function likeWork($workBehanceId,$proxy,$userAgent)
    {
        return $this->works[$workBehanceId]->likeOnce($proxy,$userAgent);
    }


    /**
     * @param $workBehanceId
     * @param $proxy
     * @param $userAgent
     * @return bool
     */
    public function viewWork($workBehanceId,$proxy,$userAgent)
    {
        return $this->works[$workBehanceId]->viewOnce($proxy,$userAgent);
    }


    /**
     * @param $proxy
     * @param $userAgent
     * @param int $count
     * @return bool
     */
    public function view($proxy,$userAgent)
    {
        return $this->_view_($this->url,$proxy,$userAgent);
    }


    /**
     * @param $url
     * @return bool
     * @throws BehanceApiException
     */
    public function getAccountFromUrl($url)
    {
        $explodedUrl = explode("/", $url);

        $username = end($explodedUrl);

        $apiString = "https://api.behance.net/v2/users/{$username}?client_id={$this->token}";

        $account = $this->behanceApiRequest($apiString);

        $this->behanceId = $account->user->id;
        $this->displayName = $account->user->display_name;
        $this->username = $account->user->username;
        $this->url = $account->user->url;
        $this->image = end($account->user->images);
        return true;
    }

}