<?php

namespace console\controllers;

use common\clases\YoutubeView;
use common\models\YoutubeQueue;
use yii\console\Controller;

class YoutubeController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        $model = YoutubeQueue::getNext();
        if (!$model) {
            $this->stdout("No url\n");
            return;
        }
        if ($model->views > 0) {
            $res = YoutubeView::run()->view($model->url);
//            $res = true;
            if($res){
                $model->views--;
                $model->save();
                $this->stdout("OK\n");
            }
            else {
                $this->stdout("Error\n");
            }

        } else {
            $model->delete();
        }

    }

}
