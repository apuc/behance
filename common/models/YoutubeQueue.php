<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "youtube_queue".
 *
 * @property int $id
 * @property string $url
 * @property string $proxy
 * @property int $views
 */
class YoutubeQueue extends \yii\db\ActiveRecord
{
    public $proxy;
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
            [['proxy'], 'safe']
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
            'proxy' => 'Proxy'
        ];
    }

    /**
     * @return array|YoutubeQueue|null
     */
    public static function getNext()
    {
        return self::find()->one();
    }

    /**
     * @return array|null
     */
    public static function getNextArray()
    {
        return self::find()->asArray()->one();
    }
}
