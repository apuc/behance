<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_works".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $link_id
 * @property int|null $type_id
 * @property int|null $balance
 * @property string|null $dt_add
 * @property string|null $url
 * @property int|null $status
 * @property int|null $quantity
 * @property int|null $sum
 */
class SocialQueue extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_PAUSE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'link_id', 'type_id', 'status', 'balance', 'quantity', 'sum'], 'integer'],
            [['dt_add'], 'safe'],
            [['url'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'user_id' => Yii::t('history', 'User ID'),
            'link_id' => Yii::t('social', 'VipIP_ID'),
            'type_id' => Yii::t('social', 'type'),
            'dt_add' => Yii::t('social', 'date'),
            'status' => Yii::t('social', 'status'),
            'url' => Yii::t('social', 'URL'),
            'balance' => Yii::t('social', '...'),
            'quantity' => Yii::t('social', 'Количество'),
            'sum' => Yii::t('social', '$'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getType()
    {
        return $this->hasOne(SocialService::className(), ['type_id' => 'type_id']);
    }

    public static function getStatus($id)
    {
        $statuses = [self::STATUS_ACTIVE => 'Работает',
            self::STATUS_INACTIVE => 'Выполнено',
            self::STATUS_PAUSE => 'Остановлено'];

        return isset($statuses[$id]) ? $statuses[$id] : null;
    }
}
