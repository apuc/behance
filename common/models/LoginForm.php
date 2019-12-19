<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{

    public $password;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = User::findByEmail($this->email);

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute,'Неверный логин или пароль!');
            }
        }
    }


	public function attributeLabels() {
		return [
			'username' => 'E-mail',
			'password' => 'Пароль',
		];
	}
}
