<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 16.11.18
 * Time: 9:41
 */

namespace frontend\widgets;
use yii\base\Widget;
use common\models\Accounts;
use common\models\Works;
use Yii;


class BehancePhoneWidget extends Widget
{

   public $userIsGuest;

   public function init()
   {
       if ($this->userIsGuest === null) {
           $this->userIsGuest = true;
       }
   }


   public function run()
   {

       if(!$this->userIsGuest)
       {
           $account = Accounts::getRandomAccount();
           $works = ($account) ? Works::getRandomWorks($account->id,6) : false;
           return $this->render('phone',compact('account','works'));
       }

       if($this->userIsGuest)
       {
           return $this->render('phone-default');
       }


   }
}