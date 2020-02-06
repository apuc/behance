<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_cash".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $order_id
 * @property int|null $amount
 * @property string|null $usd
 * @property string|null $date
 * @property int|null $is_paid
 */
class OrdersCash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_cash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'is_paid'], 'integer'],
            [['date'], 'safe'],
            [['order_id', 'usd'], 'string', 'max' => 255],
            [['order_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'order_id' => Yii::t('common', 'Order ID'),
            'amount' => Yii::t('common', 'Amount'),
            'usd' => Yii::t('common', 'Usd'),
            'date' => Yii::t('common', 'Date'),
            'is_paid' => Yii::t('common', 'Is Paid'),
        ];
    }
}
