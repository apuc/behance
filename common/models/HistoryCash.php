<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history_cash".
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int $user_id
 * @property string $dt_add
 * @property int $amount
 */
class HistoryCash extends \yii\db\ActiveRecord
{
	const TRANSFER_TO_BALANCE = 'Зачисление на баланс';
	const TRANSFER_FROM_BALANCE = 'Снятие с баланса';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_cash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['user_id', 'amount'], 'integer'],
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
            'amount' => Yii::t('history', 'Amount'),
        ];
    }


    public function beforeSave($insert)
    {

        (empty($this->amount)) ? $this->amount = 0 : "";

        return true;
    }

    /**
     * @param $user
     * @param $type
     * @param $amount
     * @param $desc
     */
	public static function create($user,$type,$amount,$desc)
    {
        $history = new self;
        $history->user_id = $user;
        $history->amount = $amount;
        $history->description = $desc;
        $history->type = $type;
        $history->dt_add = date("Y-m-d H:i:s");
        $history->save();
    }
	


	public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
	

}
