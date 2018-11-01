<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property int $id
 * @property int $accounts_id
 * @property int $views
 * @property int $likes
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accounts_id', 'views', 'likes'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('balance', 'ID'),
            'accounts_id' => Yii::t('balance', 'Accounts ID'),
            'views' => Yii::t('balance', 'Views'),
            'likes' => Yii::t('balance', 'Likes'),
        ];
    }
}
