<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "balance_сash".
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 */
class BalanceCash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'balance_cash';
    }

    /**
     * @param $user
     * @param $amount
     */
    public static function create($user,$amount)
    {
        $balance = new self;
        $balance->user_id = $user;
        $balance->amount = $amount;
        $balance->save();
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('balance', 'ID'),
            'user_id' => 'Пользователь',
            'amount' => Yii::t('balance', 'Amount'),
        ];
    }

    /**
     * @param $amount
     * @return boolean
     */
    public function addBalance($amount)
    {
//        $exponent = intval(Settings::getSetting('balance_exponent'));
        $this->amount += ((integer)$amount);
        $this->save();

        return true;
    }

    /**
     * Снятие средств с баланса
     * @param $amount
     * @return bool
     */
    public function withdrawBalance($amount)
    {
//        $exponent = intval(Settings::getSetting('balance_exponent'));
        $this->amount -= ((integer)$amount);
        if ($this->amount < 0) {
            $this->amount = 0;
        }
        $this->save();

        return true;
    }

    /**
     * @param $likes
     * @param $views
     * @return bool
     */
    public function removeFromBalance($amount)
    {

        $this->amount -= (integer)$amount;
        $this->save();

        return true;
    }



    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
