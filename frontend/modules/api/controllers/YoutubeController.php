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

}
