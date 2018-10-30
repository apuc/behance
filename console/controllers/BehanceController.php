<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.10.18
 * Time: 13:33
 */

namespace console\controllers;


use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;

use common\models\Accounts;
use common\models\Settings;
use common\models\Queue;


use common\models\Works;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\ArrayHelper;


class BehanceController extends Controller
{

    public function actionLike()
    {

        $count = Settings::find()->where('name="max_likes"')->one();
        $count = $count->value;


        $queue = Queue::find()->orderBy("id desc")->limit($count)->all();


        if(empty($queue))
            return $this->stdout("В очереди нет работ!\n", Console::FG_RED);


        foreach ($queue as $q)
        {
            $workAccount = Accounts::findOne($q->work['account_id']);


            var_dump($service->account->works); die();
            $service->account->addWork($q->work);

            $service->standardScenario($q->work->behance_id);
//            if($q->likes_count > 0 && $q->views_count >0)
//            {
//
//            }

        }

        //
        //$serv = new BehanceService($acc);
        //$serv->acc

    }

}