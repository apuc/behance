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
use common\models\History;
use common\models\Balance;
use yii\db\Exception;


class AuthService
{


   public function login($email)
   {
       $user = User::findByEmail($email);
       return Yii::$app->user->login($user);
   }



   public function signup($form,$referer)
   {
       $user = User::create($form->email,$form->password);
       $this->requestEmailConfirm($referer,$user->auth_key,$user->email);
   }



   public function emailConfirm($user,$ref)
   {
      if($ref)
      {
          $this->handleReferalLink($ref);
      }

      $this->activateUser($user);
   }



   private function handleReferalLink($refHash)
   {
       if($referer = User::findByRefHash($refHash))
       {
           $refererBalance = Balance::findOne(['user_id'=>$referer->id]);
           $refererBalance->addBalance(100,0);

           History::create(
               $referer->id,
               History::TRANSFER_TO_BALANCE,
               100,
               0,
               "Начислено 100 лайков за регестрацию по реферальной ссылке"
           );
       }
   }



   private function activateUser($user)
   {
       $auth = Yii::$app->authManager;
       $authorRole = $auth->getRole('user');
       $auth->assign($authorRole, $user->id);

       Balance::create($user->id,50,200);

       User::updateAll(['status'=>User::STATUS_ACTIVATED],['id'=>$user->id]);
   }



   private function requestEmailConfirm($referer,$key,$email)
   {
       $link = "https://{$_SERVER['HTTP_HOST']}/account-confirm?key={$key}";

       if($referer)
       {
           $link.="&ref={$referer}";
       }

       SendMail::create()->setSMTPConfig(Yii::$app->params['smtp-config'])
           ->addAddress($email)
           ->setSubject('Behance Space подтвердите аккаунт')
           ->setBody("<p>Для подтверждения аккаунта перейдите по ссылке:</p>
                                <p><a href=\'{$link}\'>{$link}</a></p>")
           ->setFrom('info@behance.space', 'BS')
           ->isHTML()
           ->send();
   }
}