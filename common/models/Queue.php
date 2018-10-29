<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "queue".
 *
 * @property int $id
 * @property int $work_id
 * @property int $likes_count
 * @property int $views_count
 */
class Queue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_id', 'likes_count', 'views_count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('queue', 'ID'),
            'work_id' => Yii::t('queue', 'Work ID'),
            'likes_count' => Yii::t('queue', 'Likes Count'),
            'views_count' => Yii::t('queue', 'Views Count'),
        ];
    }
}
