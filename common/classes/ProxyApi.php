<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 25.02.19
 * Time: 10:11
 */

namespace common\classes;


class ProxyApi
{
    public $proxy;

    public function parse()
    {
        $this->createArr();
        return $this;
    }

    public function rnd()
    {
        return $this->proxy[rand(0, count($this->proxy))];
    }

    public function all()
    {
        return $this->proxy;
    }

    private function getProxy($data = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api.foxtools.ru/v2/Proxy");
        curl_setopt($ch, CURLOPT_POST, 1);
        $query = '';
        if ($data) {
            $query = http_build_query($data);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        return $server_output;
    }

    private function createArr()
    {
        $res = json_decode($this->getProxy());
        $this->proxy = [];
        $pageCount = $res->response->pageCount;
        for ($i = 1; $i <= $pageCount; $i++) {
            $arr = json_decode($this->getProxy(['page' => $i]));
            $this->proxy = array_merge($this->proxy, $arr->response->items);
        }
    }

    public static function dump($c)
    {
        echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
        print_r($c);
        echo '</pre>';
    }

    public static function run()
    {
        return new self();
    }

}