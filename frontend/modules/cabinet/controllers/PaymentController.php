<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 27.11.18
 * Time: 9:41
 */

namespace frontend\modules\cabinet\controllers;

use common\classes\FreeCassa;
use common\models\Cases;
use Yii;
use yii\web\Controller;


class PaymentController extends Controller
{

    public function actionIndex()
    {
        $cases = Cases::findAll(['status' => 1]);
        $res = array();
        $defaultCase = $cases[0];

        $order_id = uniqid('id_');
        $form_sign = FreeCassa::generateSign($defaultCase->price, FreeCassa::SECRET_1, $order_id);

        foreach ($cases as $case) {
            $res[$case->id . "|" . $case->price] = $case->__toString();
        }

        return $this->render('pay-form', [
                'cases' => $res,
                'defaultCase' => $defaultCase,
                'merchant_id' => FreeCassa::SHOP_ID,
                'form_sign' => $form_sign,
                'order_id' => $order_id
            ]
        );
    }


    public function actionGetFormSecret()
    {
        $id = Yii::$app->request->post('order_id');
        $sum = Yii::$app->request->post('sum');;
        return FreeCassa::generateSign($sum, FreeCassa::SECRET_1, $id);
    }
}