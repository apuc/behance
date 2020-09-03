<?php

namespace common\models;

use common\classes\Debug;
use Yii;

/**
 * This is the model class for table "youtube_queue".
 *
 * @property int $id
 * @property string $url
 * @property string $proxy
 * @property string $img
 * @property int $views
 * @property int $duration
 * @property string $name
 * @property int $like
 * @property int $dislike
 * @property int $count_views
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
            [['views', 'duration', 'count_views', 'like', 'dislike'], 'integer'],
            [['url', 'img', 'name'], 'string', 'max' => 255],
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
            'proxy' => 'Proxy',
            'duration' => 'Продолжительность, (с)',
            'img' => 'Ссылка на изображение',
            'name' => 'Название видео',
            'like' => 'Количестов лайков',
            'dislike' => 'Количество дизлайков',
            'count_views' => 'Количество просмотров'
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

    public static function getQueues($count)
    {
        return self::find()->limit($count)->all();
    }

    public static function decrementQueue($id)
    {
        $queue = self::findOne($id);
        if ($queue->views == 0) {
            YoutubeQueue::deleteAll(['id' => $id]);
        } else {
            --$queue->views;
        }

        return $queue->save();
    }
}
