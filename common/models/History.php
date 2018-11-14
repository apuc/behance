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
	const TRANSFER_FROM_BALANCE = 'Снятие с баланса';
	const CREATE_BALANCE = 'Создание счета';
	const DELETE_BALANCE = 'Удаление счета';
	const DEBIT = 'Дебит';
	const CREDIT = 'Кредит';
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
	


    /**
     * @param $user_id
     * @param $type
     * @param $likes
     * @param $views
     * @param $desc
     */
	public function setHistory($user_id,$type,$likes,$views,$desc)
    {
       $this->user_id = $user_id;
       $this->likes = $likes;
       $this->views = $views;
       $this->description = $desc;
       $this->type = $type;
       $this->dt_add = date("Y-m-d H:i:s");
       $this->save();
    }
	

    public function getTypes()
    {

    }


	public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
	
	public function setDebit($user_id, $views, $likes, $desc) {
    	$history = new History();
    	$history->user_id = $user_id;
    	$history->views = $views;
    	$history->likes = $likes;
    	$history->type = self::DEBIT;
    	$history->description = $desc;
    	$history->save();
	}
	
	public function setCredit($user_id, $views, $likes, $desc) {
		$history = new History();
		$history->user_id = $user_id;
		$history->views = $views;
		$history->likes = $likes;
		$history->type = self::CREDIT;
		$history->description = $desc;
		$history->save();
	}
}
