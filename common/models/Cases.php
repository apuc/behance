<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property int $id
 * @property int $views
 * @property int $likes
 * @property string $name
 * @property string $img
 * @property int $status
 * @property string $price
 * @property string $term
 */
class Cases extends \yii\db\ActiveRecord
{
	const STATUS = [
		'0' => 'Отключен',
		'1' => 'Включен',
	];
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
            [['views', 'likes', 'status'], 'integer'],
            [['img'], 'string'],
            [['price'], 'number'],
            [['name', 'term'], 'string', 'max' => 255],
            [['views', 'likes','name','price','term'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cases', 'ID'),
            'views' => Yii::t('cases', 'Views'),
            'likes' => Yii::t('cases', 'Likes'),
            'name' => Yii::t('cases', 'Name'),
            'img' => Yii::t('cases', 'Img'),
            'status' => Yii::t('cases', 'Status'),
            'price' => Yii::t('cases', 'Price'),
            'term' => Yii::t('cases', 'Term'),
        ];
    }
}
