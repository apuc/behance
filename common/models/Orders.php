<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $accounts_id
 * @property int $cases_id
 * @property int $status
 * @property string $dt_add
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accounts_id', 'cases_id', 'status'], 'integer'],
            [['dt_add'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('orders', 'ID'),
            'accounts_id' => Yii::t('orders', 'Accounts ID'),
            'cases_id' => Yii::t('orders', 'Cases ID'),
            'status' => Yii::t('orders', 'Status'),
            'dt_add' => Yii::t('orders', 'Dt Add'),
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
