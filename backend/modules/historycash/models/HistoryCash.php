<?php

namespace backend\modules\historycash\models;

use Yii;

/**
 * Class HistoryCash
 * @package backend\modules\historycash\models
 */
class HistoryCash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history-cash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['user_id'], ['amount'], 'integer'],
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
            'id' => Yii::t('history-cash', 'ID'),
            'type' => Yii::t('history-cash', 'Name'),
            'description' => Yii::t('history-cash', 'Description'),
            'user_id' => Yii::t('history-cash', 'User ID'),
            'dt_add' => Yii::t('history-cash', 'Dt Add'),
            'amount' => Yii::t('history-cash', 'Amount'),
        ];
    }
}