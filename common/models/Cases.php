<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property int $id
 * @property int $behance_id
 * @property int $views
 * @property int $likes
 */
class Cases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['behance_id', 'views', 'likes'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cases', 'ID'),
            'behance_id' => Yii::t('cases', 'Behance ID'),
            'views' => Yii::t('cases', 'Views'),
            'likes' => Yii::t('cases', 'Likes'),
        ];
    }
}
