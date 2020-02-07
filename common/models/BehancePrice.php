<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "behance_prices".
 *
 * @property int $id
 * @property string|null $service
 * @property int|null $price
 */
class BehancePrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'behance_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['service'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'service' => Yii::t('common', 'Service'),
            'price' => Yii::t('common', 'Price'),
        ];
    }
}
