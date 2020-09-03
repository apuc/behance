<?php

namespace backend\modules\queue\models;

use Yii;

/**
 * This is the model class for table "queue".
 *
 * @property int $id
 * @property int $work_id
 * @property int $likes_work
 * @property int $views_work
 * @property int $account_views
 */
class Queue extends \common\models\Queue
{
}
