<?php
namespace frontend\controllers;

use common\models\Settings;
use common\models\Works;
use yii\db\StaleObjectException;
use yii\web\Controller;
use common\models\Queue;

/**
 * Site controller
 */
class BehanceController extends Controller
{
    public function actionGet($api_key, $count = 10)
    {
        $key = Settings::getSetting('api_key');
        if (strcmp($key, $api_key) == 0) {
            $rows = (new \yii\db\Query())
                ->select(['queue.id', 'work_id', 'likes_work', 'views_work', 'url'])
                ->from('queue')
                ->join('INNER JOIN', 'works', 'works.id = queue.work_id')
                ->limit($count)
                ->all();
            return json_encode($rows);
        }
        return json_encode(null);
    }

    public function actionUpdate($api_key, $id, $likes, $views)
    {
        $key = Settings::getSetting('api_key');
        if (strcmp($key, $api_key) == 0) {
            $item = Queue::findOne(['id' => $id]);
            $item->views_work = $views;
            $item->likes_work = $likes;
            $item->save();
            if ($item->views_work == 0 && $item->likes_work == 0) {
                try {
                    $item->delete();
                } catch (StaleObjectException $e) {
                } catch (\Throwable $e) {
                }
                return json_encode(2);
            }
            return json_encode(1);
        }
        return json_encode(-1);
    }
}
