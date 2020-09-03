<?php

namespace backend\modules\socialqueue\models;

use Yii;

/**
 * Class SocialQueue
 * @package backend\modules\socialqueue\models
 */
class SocialQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social-queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], ['balance'], ['status'], 'string'],
            [['user_id'], ['link_id'], ['type_id'], 'integer'],
            [['dt_add'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social-queue', 'ID'),
            'user_id' => Yii::t('social-queue', 'User ID'),
            'link_id' => Yii::t('social-queue', 'Link ID'),
            'type_id' => Yii::t('social-queue', 'Type ID'),
            'url' => Yii::t('social-queue', 'url'),
            'balance' => Yii::t('social-queue', 'Balance'),
            'dt_add' => Yii::t('social-queue', 'Dt Add'),
            'status' => Yii::t('history-cash', 'status'),
        ];
    }
}