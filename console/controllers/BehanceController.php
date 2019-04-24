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
use common\models\User;
use common\models\Works;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\ArrayHelper;


class BehanceController extends Controller
{

    public function actionLike()
    {
        $takeFfromQueue = Settings::getSetting('max_likes');
        $isForce = Settings::getSetting('is_force_enabled');
        $forceMax = Settings::getSetting('force_max');

        $queue = Queue::find()->orderBy("id desc")->limit($takeFfromQueue)->all();

        if(empty($queue)){
            return $this->stdout("В очереди нет работ!\n", Console::FG_RED);
        }

        $service = BehanceService::create(new BehanceAccount());

        if($isForce)
        {
            for ($i = 0; $i<$forceMax; $i++) {
                $this->like($service,$queue);
            }

            return true;
        }

        $this->like($service,$queue);
    }



    private function like($service,$queue)
    {
        foreach ($queue as $q)
        {
            if($q->likes_work == 0 && $q->views_work == 0)
            {
                $q->delete();
                $this->stdout("Работа {$q->work['name']} вышла из очереди!\n",Console::FG_RED);
                continue;
            }

            $workAccount = Accounts::findOne($q->work['account_id']);

            $service->importAccount($workAccount);
            $service->account->addWork($q->work);

            $this->stdout("Применяем сценарий к работе {$q->work['name']} !\n",Console::FG_GREEN);

            if($q->likes_work > 0 && $q->views_work > 0)
            {
                if($service->standardScenario($q->work['behance_id']))
                {
                    $q->refreshLikes(1,1);
                    $this->stdout("Сценарий успешно применен!\n",Console::FG_GREEN);
                    continue;
                }

                $this->stdout("Ошибка!\n",Console::FG_RED);
                continue;
            }

            if($q->likes_work > 0 && $q->views_work == 0)
            {
                if($service->onlyLikeScenario($q->work['behance_id']))
                {
                    $q->refreshLikes(1,0);
                    $this->stdout("Сценарий успешно применен!\n",Console::FG_GREEN);
                    continue;
                }

                $this->stdout("Ошибка!\n",Console::FG_RED);
                continue;
            }

            if($q->likes_work == 0 && $q->views_work > 0)
            {
                if($service->onlyViewScenario($q->work['behance_id']))
                {
                    $q->refreshLikes(0,1);
                    $this->stdout("Сценарий успешно применен!\n",Console::FG_GREEN);
                    continue;
                }

                $this->stdout("Ошибка!\n",Console::FG_RED);
                continue;
            }
        }
    }

}
