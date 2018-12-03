<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $title;
    public $descr;
    public $keywords;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['title', 'trim'],
            ['title', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['', 'required'],
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
