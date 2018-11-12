<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int $user_id
 * @property string $dt_add
 * @property int $likes
 * @property int $views
 */
class History extends \yii\db\ActiveRecord
{
	const TRANSFER_TO_BALANCE = 'Зачисление на баланс';
	const CREATE_BALANCE = 'Создание счета';
	const DELETE_BALANCE = 'Удаление счета';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['user_id', 'likes', 'views'], 'integer'],
            [['dt_add'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('history', 'ID'),
            'type' => Yii::t('history', 'Type'),
            'description' => Yii::t('history', 'Description'),
            'user_id' => Yii::t('history', 'User ID'),
            'dt_add' => Yii::t('history', 'Dt Add'),
            'likes' => Yii::t('history', 'Likes'),
            'views' => Yii::t('history', 'Views'),
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
	
	public function delBalance($accounts_id){
		$history = new History();
		$history->accounts_id = $accounts_id;
		$history->name = self::DELETE_BALANCE;
		$history->description = self::DELETE_BALANCE;
		$history->save();
	}
	
}
