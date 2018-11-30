<?php

namespace frontend\controllers;

class PaymentController extends \yii\web\Controller
{
    private $secret1 = '32rfcqqv';
    private $secret2 = '4ovny78u';
    private $merchant_id = '107781';

    public function actionPaymentFailed()
    {
        return $this->render('payment-failed');
    }



    public function actionPaymentSuccess()
    {
        return $this->render('payment-success');
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



    private function generateSign($sum,$secret,$order_id)
    {
        return md5("{$this->merchant_id}:{$sum}:{$secret}:{$order_id}");
    }

}
