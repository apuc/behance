<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $photo
 * @property string $name
 * @property string $nick_name
 * @property string $content
 * @property string $dt_add
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['dt_add'], 'safe'],
            [['photo', 'name', 'nick_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('reviews', 'ID'),
            'photo' => Yii::t('reviews', 'Photo'),
            'name' => Yii::t('reviews', 'Name'),
            'nick_name' => Yii::t('reviews', 'Nick Name'),
            'content' => Yii::t('reviews', 'Content'),
            'dt_add' => Yii::t('reviews', 'Dt Add'),
        ];
    }
	
	public function beforeSave( $insert ) {
		if ( parent::beforeSave( $insert ) ) {
			$date = date("Y-m-d H:i:s");
			$this->dt_add = $date;
			return true;
		}
		return false;
	}
}
