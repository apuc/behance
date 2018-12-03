<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $email;
    public $password;
    public $password_repeat;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email уже занят!'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat', 'required'],
            ['password_repeat', 'compare','compareAttribute' => 'password'],
            ['password_repeat', 'string', 'min' => 6],
        ];
    }
	
	public function attributeLabels() {
		return [
			'username' => 'Логин',
			'password' => 'Пароль',
			'password_repeat' => 'Повторите пароль',
		];
	}
}
