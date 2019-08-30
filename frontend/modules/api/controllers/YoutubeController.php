<?php

namespace frontend\modules\api\controllers;

use common\behance\traits\RepoTrait;
use common\models\YoutubeQueue;

class YoutubeController extends \yii\web\Controller
{
    use RepoTrait;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNext()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $res = YoutubeQueue::getNextArray();
        $res['proxy'] = $this->getRandomProxy();
        return $res;
    }

    public function actionGetQueues($count)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $res = YoutubeQueue::getQueues($count);
        return $res;
    }

    public function actionDecrementQueue($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (YoutubeQueue::decrementQueue($id)) {

            return "Success";
        }
        return "Error";
    }
}
