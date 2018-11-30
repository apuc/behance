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
    private $secret1 = '32rfcqqv';
    private $secret2 = '4ovny78u';
    private $merchant_id = '107781';


    public function actionIndex()
    {
       $cases = Cases::findAll(['status'=>1]);
       $res = array();
       $defaultCase = $cases[0];

       $order_id = uniqid('id_');
       $form_sign = $this->generateSign($defaultCase->price,$this->secret1,$order_id);

       foreach ($cases as $case)
       {
          $res[$case->id."|".$case->price] = $case->__toString();
       }

       return $this->render('pay-form',[
           'cases'=>$res,
           'defaultCase'=>$defaultCase,
           'merchant_id'=>$this->merchant_id,
               'form_sign'=>$form_sign,
            'order_id'=>$order_id
           ]
       );
    }



    public function actionPaymentSuccess()
    {
       return $this->render('payment-success');
    }



    public function actionPaymentFailed()
    {
       return $this->render('payment-fail');
    }


    public function actionPaymentResults()
    {
       $post = Yii::$app->request->post();

       $sign = $this->generateSign($post['AMOUNT'],$this->secret2,$post['MERCHANT_ORDER_ID']);

       if($sign == $post['SIGN'])
       {
          $user = $post['us_userid'];

          $case = Cases::findOne(['id'=>$post['us_caseid']]);

          if($post['AMOUNT'] == $case->price)
          {
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
    }



    public function actionGetFormSecret()
    {
        $id = Yii::$app->request->post('order_id');
        $sum = Yii::$app->request->post('sum');;
        return $this->generateSign($sum,$this->secret1,$id);
    }



    private function generateSign($sum,$secret,$order_id)
    {
       return md5("{$this->merchant_id}:{$sum}:{$secret}:{$order_id}");
    }

}