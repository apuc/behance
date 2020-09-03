<?php

namespace console\controllers;

use common\models\Settings;
use common\models\SocialQueue;
use VipIpRuClient\Enum\StatusType;
use VipIpRuClient\SocialWrapper;
use Yii;
use yii\base\ErrorException;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\ArrayHelper;


class CronController extends Controller
{
    public function actionCheckJobs() {
        $active_jobs = [];
        foreach(SocialQueue::find()->where(['status' => 1])->all() as $job) {
            $active_jobs[$job->link_id] = $job;
        }

        $wrapper = new SocialWrapper(Settings::getSetting('access_token'));
        $ids = [];
        foreach ($active_jobs as $job) {
            $ids[] = $job->link_id;
        }
        $wrapper_jobs = $wrapper->getJobs($ids);

        $is_done = true;
        $transaction = Yii::$app->db->getTransaction();
        if ($transaction !== null) {
            $transaction = null;
        }
        else {
            $transaction = Yii::$app->db->beginTransaction();
        }
        try  {
            foreach ($wrapper_jobs as $job) {
                $active_jobs[$job->linkid]->status = $job->status === StatusType::DISABLED()->getValue() ? 0 : 1;
                $active_jobs[$job->linkid]->balance = $job->balance;
                if(!$active_jobs[$job->linkid]->save()) {
                    throw new ErrorException('failed saving');
                }
            }
            $transaction->commit();
        } catch (ErrorException $e) {
            $is_done = false;
            $transaction->rollBack();
        }
        return $is_done;
    }
}
