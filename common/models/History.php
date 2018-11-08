<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $accounts_id
 * @property string $dt_add
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
            [['accounts_id'], 'integer'],
            [['dt_add'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('history', 'ID'),
            'name' => Yii::t('history', 'Name'),
            'description' => Yii::t('history', 'Description'),
            'accounts_id' => Yii::t('history', 'Accounts ID'),
            'dt_add' => Yii::t('history', 'Dt Add'),
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
