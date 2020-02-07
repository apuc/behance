<?php


namespace backend\modules\prices\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "behance_prices".
 *
 * @property int $id
 * @property string $key
 * @property int|float $value
 */
class FormModel extends Model
{
    public $id;
    public $key;
    public $value;
    public $is_setting;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'number'],
            [['is_setting'], 'integer'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'key' => Yii::t('common', 'Service'),
            'value' => Yii::t('common', 'Price'),
        ];
    }
}
