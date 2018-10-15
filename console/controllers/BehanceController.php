<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.10.18
 * Time: 13:33
 */

namespace console\controllers;
use backend\modules\behance\models\BehanceOption;
use backend\modules\behance\models\BehanceQueue;

use Yii;
use yii\console\Controller;
use backend\modules\behance\models\BehanceWork;
use backend\modules\behance\models\Proxy;
use yii\helpers\Console;

class BehanceController extends Controller
{

    private $user_agents = [
        'Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27',
        'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
    ];

    public function actionLike()
    {
        $likes = BehanceOption::find()->where('name="max_likes"')->one();
        $likes = $likes->value;

        $queue = BehanceQueue::find()->orderBy("id desc")->limit($likes)->all();

        if(empty($queue))
            return $this->stdout("В очереди нет работ!\n", Console::FG_RED);

        $proxy_ids = Proxy::find()->asArray()->select("id")->column();

        foreach ($queue as $q)
        {
            $work = $q->work;

            $this->stdout("Лайкаем работу: ".$work->url."\n", Console::FG_YELLOW);

            $work_url = $work->url;
            $account_url = $work->account['url'];

            //берем случайный proxy ip из таблицы
            $proxy_id = $proxy_ids[rand(0,count($proxy_ids)-1)];
            $proxy = Proxy::find()->where("id=".$proxy_id)->one();

            //выбираем случайный юзерагент
            $user_agent = $this->user_agents[rand(0,3)];

            $behance_id = $work->behance_id;
            $like_url =  "https://www.behance.net/v2/projects/".$behance_id."/appreciate?client_id=BehanceWebSusi1";

            $res = $this->LikeWork($work_url,$account_url,$proxy->ip,$user_agent,$like_url);


            //var_dump(trim($res));
            if(trim($res) == '0')
            {
                $this->stdout("Лайк поставлен! \n", Console::FG_GREEN);

                 $que = BehanceQueue::findOne(['work_id'=>$work->id]);
                 $que->likes_count = $que->likes_count-1;

                 if($que->likes_count == 0)
                 {
                     $que->delete();
                     $this->stdout("Работа вышла из очереди!\n", Console::FG_GREEN);
                 }
                 else
                 {
                     $this->stdout("Осталось лайков: ".$que->likes_count."\n", Console::FG_GREEN);
                     $que->save();
                 }
            }
            else
            {
                $this->stdout($res."\n", Console::FG_RED);
            }
        }

    }

    private function LikeWork($work_url,$account_url,$proxy,$user_agent,$like_url)
    {

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $account_url);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl,  CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_exec($curl);
            $error = curl_error($curl)." ".curl_errno($curl);

            curl_setopt($curl, CURLOPT_URL, $work_url);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl,  CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_REFERER, $account_url);
            curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_exec($curl);
            $error = curl_error($curl)." ".curl_errno($curl);

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL,$like_url);
            curl_setopt($curl,  CURLOPT_PROXY, $proxy);
            curl_setopt($curl,CURLOPT_USERAGENT, $user_agent);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            $res = curl_exec($curl);

            $error = curl_error($curl)." ".curl_errno($curl);

            curl_close($curl);
            return $error;

    }
}