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
use common\models\Settings;
use frontend\modules\cabinet\models\Balance;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use common\classes\FreeCassa;


class PaymentCashController extends Controller
{

    public function actionIndex()
    {
       //$cases = Cases::findAll(['status'=>1]);
       //$res = array();
       //$defaultCase = $cases[0];
       $default_sum = 300.00;
       $exchange_rate = Settings::getSetting('exchange_rate_usd');
       $default_usd = round($default_sum / floatval($exchange_rate), 6);

       $order_id = uniqid('id_');
       $form_sign = FreeCassa::generateSign($default_sum.'.00',FreeCassa::SECRET_1,$order_id);

       //foreach ($cases as $case)
       //{
       //   $res[$case->id."|".$case->price] = $case->__toString();
       //}

       return $this->render('pay-form',[
           'default_sum' => $default_sum.'.00',
           'merchant_id' => FreeCassa::SHOP_ID,
           'form_sign' => $form_sign,
           'order_id' => $order_id,
           'exchange_rate' => $exchange_rate,
           'default_usd' => $default_usd
       ]);
    }


    public function actionGetFormSecret()
    {
        $id = Yii::$app->request->post('order_id');
        $sum = Yii::$app->request->post('sum');;
        return FreeCassa::generateSign($sum,FreeCassa::SECRET_1,$id);
    }
}