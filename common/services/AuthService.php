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
use common\clases\SendMail;


class AuthService
{
   public function login($form)
   {
       $user = User::findByEmail($form->email);
       return Yii::$app->user->login($user);
   }

   public function signup($form,$referer)
   {
       $user = User::create($form->email,$form->password);
       $this->requestEmailConfirm($referer,$user->auth_key);
   }

   public function emailConfirm($user,$ref)
   {
      if($ref)
      {
          $referer_balance = Balance::findOne(['user_id'=>$user->id]);
          $referer_balance->addBalance(100,0);

          History::create(
              $user->id,
              History::TRANSFER_TO_BALANCE,
              100,
              0,
              "Начислено 100 лайков за регестрацию по реферальной ссылке"
          );
      }
   }

   private function activateUser()
   {

   }

   private function requestEmailConfirm($referer,$key)
   {
       $link = "https://{$_SERVER['HTTP_HOST']}/account-confirm?key={$key}";

       if($referer)
       {
           $link.="&ref={$referer}";
       }

       SendMail::create()->setSMTPConfig([
           'host' => 'ssl://mail.adm.tools',
           'port' => 465,
           'username' => 'info@behance.space',
           'password' => '123edsaqw',
       ])
           ->addAddress($this->email)
           ->setSubject('Behance Space подтвердите аккаунт')
           ->setBody("<p>Для подтверждения аккаунта перейдите по ссылке:</p>
                                <p><a href=\'{$link}\'>{$link}</a></p>")
           ->setFrom('info@behance.space', 'BS')
           ->isHTML()
           ->send();
   }
}