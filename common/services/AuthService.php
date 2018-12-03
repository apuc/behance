<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 03.12.18
 * Time: 15:31
 */

namespace common\services;

use common\models\User;
use Yii;


class AuthService
{
   public function login($data)
   {
      $user = User::findByEmail($data->email);

      if($user->validatePassword($data->password))
      {
          return Yii::$app->user->login($user);
      }

     return false;
   }
}