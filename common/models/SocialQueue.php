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
 */
class SocialQueue extends \yii\db\ActiveRecord
{
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
            [['user_id', 'link_id', 'type_id', 'status', 'balance'], 'integer'],
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
            'user_id' => Yii::t('social', 'user'),
            'link_id' => Yii::t('social', 'link'),
            'type_id' => Yii::t('social', 'type'),
            'dt_add' => Yii::t('social', 'date'),
            'status' => Yii::t('social', 'status'),
            'url' => Yii::t('social', 'url'),
            'balance' => Yii::t('social', 'balance'),
        ];
    }
}
