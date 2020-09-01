<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property string $phone_number
 * @property string $dt_add
 * @property int $status
 */
class Callback extends \yii\db\ActiveRecord
{
    const UNCHECKED = 0;
    const CHECKED = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    public static function create($phone)
    {
        $callback = new self;
        $callback->phone_number = $phone;
        $callback->status = self::UNCHECKED;
        $callback->dt_add = date("Y-m-d H:i:s");
        $callback->save();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['phone_number', 'dt_add'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_number' => 'Номер телефона',
            'dt_add' => 'Дата',
            'status' => 'Статус',
        ];
    }
}
