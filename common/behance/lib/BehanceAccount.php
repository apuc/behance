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


class BehanceAccount implements AccountInterface
{
    use CommonTrait;

    public $behanceId;
    public $displayName;
    public $username;
    public $url;
    public $image;
    public $works = [];
    private $token;



    public function __construct()
    {
        $this->token = Config::get()['apiKey'];
    }



    public function importWorks($works)
    {
        foreach ($works as $work)
        {

            $this->addWork($work);
        }
    }



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



    public function addWork($work)
    {
        $data = array();
        $data['behance_id'] = (isset($work->behance_id)) ? $work->behance_id : $work->id;
        $data['name'] = $work->name;
        $data['url'] = $work->url;
        $data['start_likes'] = $work->stats->appreciations;
        $data['start_views'] = $work->stats->views;
        $data['image'] = (isset($work->covers)) ? end($work->covers) : $work->image;
        $data['id'] = (isset($work->behance_id)) ? $work->id : null;
        $data['account_id'] = (isset($work->behance_id)) ? $work->account_id : null;

        $workObj = new BehanceWork($data);

        $this->works[$data['behance_id']] = $workObj;
    }



    public function likeWork($data)
    {
        if (count($data) > 1) {
            foreach ($data as $item) {
                $this->works[$item['id']]->like($item['likes']);
            }
        } else {
            $this->works[$data[0]['id']]->like($data[0]['likes']);
        }
    }



    public function viewWork($data)
    {
        if (count($data) > 1) {
            foreach ($data as $item) {
                $this->works[$item['id']]->view($item['views']);
            }
        } else {
            $this->works[$data[0]['id']]->view($data[0]['views']);
        }
    }



    public function view($count = 1)
    {
        $this->_view_($count, $this->url);
    }



    public function getAccountFromUrl($url)
    {
        $explodedUrl = explode("/", $url);

        $username = end($explodedUrl);

        $apiString = "https://api.behance.net/v2/users/{$username}?client_id={$this->token}";

        $account = $this->behanceApiRequest($apiString);


        if($account->http_code != '200')
        {

           return false;
        }

        $this->behanceId = $account->user->id;
        $this->displayName = $account->user->display_name;
        $this->username = $account->user->username;
        $this->url = $account->user->url;
        $this->image = end($account->user->images);
        return true;
    }

}