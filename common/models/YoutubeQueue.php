<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "youtube_queue".
 *
 * @property int $id
 * @property string $url
 * @property int $views
 */
class YoutubeQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'youtube_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'views'], 'required'],
            [['views'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'views' => 'Views',
        ];
    }

    /**
     * @return array|YoutubeQueue|null
     */
    public static function getNext()
    {
        return self::find()->one();
    }
}
