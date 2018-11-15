<?php

namespace common\models;

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
class Queue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queue';
    }


    public function beforeSave($insert)
    {

       (empty($this->likes_work)) ? $this->likes_work = 0 : "";
       (empty($this->views_work)) ? $this->views_work = 0 : "";
       (empty($this->account_views)) ? $this->account_views = 0 : "";

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_id', 'likes_work', 'views_work', 'account_views'], 'integer'],
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
            'likes_work' => Yii::t('queue', 'Likes Work'),
            'views_work' => Yii::t('queue', 'Views Work'),
            'account_views' => Yii::t('queue', 'Account Views'),
        ];
    }


    public function getWork()
    {
        return $this->hasOne(Works::className(),['id'=>'work_id']);
    }
}
