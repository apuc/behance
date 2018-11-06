<?php

namespace frontend\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property int $id
 * @property int $accounts_id
 * @property int $views
 * @property int $likes
 */
class Balance extends \common\models\Balance
{
	public $history;
}
