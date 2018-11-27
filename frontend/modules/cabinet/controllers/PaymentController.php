<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 27.11.18
 * Time: 9:41
 */

namespace frontend\modules\cabinet\controllers;

use common\models\Cases;
use common\models\History;
use frontend\modules\cabinet\models\Balance;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class PaymentController extends Controller
{
   public function actionIndex()
   {
       $cases = Cases::findAll(['status'=>1]);
       $res = array();
       $defaultCase = $cases[0];

       foreach ($cases as $case)
       {
          $res[$case->id."|".$case->price] = $case->__toString();
       }

       return $this->render('pay-form',['cases'=>$res,'defaultCase'=>$defaultCase]);
   }



   public function actionPaymentSuccess()
   {
       return $this->render('payment-success');
   }



   public function actionPaymentFailed()
   {
       return $this->render('payment-fail');
   }



   public function actionPaymentWaiting()
   {
       return $this->render('payment-waiting');
   }



   public function actionPaymentResults()
   {
       $post= Yii::$app->request->post();

       if($this->validateSign($post,$post['ik_sign']))
       {
         $user = $post['ik_x_userid'];

         $case = Cases::findOne(['id'=>$post['ik_x_caseid']]);

         $balance = Balance::findOne(['user_id'=>$user]);
         $balance->addBalance($case->likes,$case->views);

         History::create(
             $user,
             History::TRANSFER_TO_BALANCE,
             $case->likes,
             $case->views,
             'Баланс пополнен!'
             );

       }

   }



   private function validateSign($dataSet,$formSign)
   {
       unset($dataSet['ik_sign']); //удаляем из данных строку подписи
       ksort($dataSet, SORT_STRING); // сортируем по ключам в алфавитном порядке элементы массива
       array_push($dataSet, 'Yy1lf542PSBn8xNm'); // добавляем в конец массива "секретный ключ"
       $signString = implode(':', $dataSet); // конкатенируем значения через символ ":"
       $sign = base64_encode(md5($signString, true)); // берем MD5 хэш в бинарном виде по

       if($sign == $formSign)
       {
         return true;
       }

       return false;
   }

}