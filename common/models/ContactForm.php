<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_form".
 *
 * @property int $id
 * @property int $status
 * @property string $name
 * @property string $email
 * @property string $link
 * @property string $message
 * @property string $dt_add
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'link'], 'required'],
            [['name', 'email', 'link','message'], 'trim'],
            [['dt_add'], 'safe'],
            [['status'], 'safe'],
            [['email'], 'email'],
            [['link'], 'url'],
        ];
    }

    public function beforeSave($insert)
    {
        $this->dt_add = date('d-m-Y H:i:s');
        $this->status = 0;
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'name' => 'Имя',
            'email' => 'Email',
            'link' => 'Ссылка',
            'message' => 'Сообщение',
            'dt_add' => 'Дата отправки',
        ];
    }
}
