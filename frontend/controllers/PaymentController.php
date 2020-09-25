<?php

namespace frontend\controllers;

use common\models\BalanceCash;
use common\models\HistoryCash;
use common\models\OrdersCash;
use common\models\Settings;
use DateTime;
use frontend\modules\api\services\TelegramApiServices;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Yii;
use common\models\Cases;
use common\models\Balance;
use common\models\History;
use common\classes\FreeCassa;
use yii\filters\VerbFilter;


class PaymentController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'payment-results' => ['post'],
                ],
            ],
        ];
    }


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


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
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/error.log', Logger::ERROR));

//        $tmp = '111112123';
//        $model = new OrdersCash();
//        $model->user_id = 1;
//        $model->order_id = 'id_5f6da3046bda66.18621041_1';
//        $model->usd = '777.77';
//        $model->amount = 77;
//        $model->date = date('Y-m-d H-i-s');
//        $model->is_paid = 0;
//        $model->save();
//        //$model->validate();
//        //var_dump($model->errors);exit();
//
//        $post['us_userid'] = 1;
//        $post['us_usd'] = 1;
//        $post['MERCHANT_ORDER_ID'] = $tmp;
//        $post['AMOUNT'] = 777;
        try
        {
            $log->error("POST DATA: ".implode(Yii::$app->request->post()));
            $curr_date = new DateTime(date("Y-m-d H:i:s"));

            $post = Yii::$app->request->post();

            $sign = FreeCassa::generateSign($post['AMOUNT'],FreeCassa::SECRET_2, $post['MERCHANT_ORDER_ID']);
            if ($sign == $post['SIGN'])
            //if (true)
            {
                $user = $post['us_userid'];

                if (isset($post['us_caseid'])) {
                    $case = Cases::findOne(['id' => $post['us_caseid']]);
                    if ($post['AMOUNT'] == $case->price) {
                        $balance = Balance::findOne(['user_id' => $user]);
                        $balance->addBalance($case->likes, $case->views);
                        History::create(
                            $user,
                            History::TRANSFER_TO_BALANCE,
                            $case->likes,
                            $case->views,
                            "Применен пакет {$case->name}!"
                        );
                    } else {
                        throw new \Exception("Wrong amount!");
                    }
                } elseif (isset($post['us_usd'])) {

                    $order = OrdersCash::findOne(['order_id' => $post['MERCHANT_ORDER_ID'], 'is_paid' => 0]);
                    if ($order) {
                        $is_correct_amount = $order->amount == $post['AMOUNT'];

                        $log->error("is_correct_amount: ". (string)$is_correct_amount);

                        $exponent = intval(Settings::getSetting('balance_exponent'));
                        $order_usd = intval(round(floatval($order->usd), 6) * $exponent);
                        $log->error("order_usd: ". (string) $order_usd);
                        $post_usd = intval(round(floatval($post['us_usd']), 6) * $exponent);
                        $log->error("post['us_usd']: ". (string) $post['us_usd']);

//                        var_dump($order_usd);
//                        var_dump($post_usd);
//                        exit();

                        $is_correct_usd = $order_usd == $post_usd;
                        $log->error("is_correct_usd: ". (string) $is_correct_usd);

                        $is_correct_usd = true;
                        $order_date = new DateTime($order->date);
                        $expire_days = intval(Settings::getSetting('expiration_days'));
                        $is_still_valid = $curr_date->diff($order_date)->days < $expire_days;
                        if ($is_correct_amount) {
                            if ($is_correct_usd) {
                                if ($is_still_valid) {
                                    $balance = BalanceCash::findOne(['user_id' => $user]);
                                    $amount = $post['us_usd'];
                                    $balance->addBalance($amount);
                                    $order->is_paid = 1;
                                    $order->save();
                                    $log->error("IS_PAID: ".$order->is_paid);
                                    $log->error("USER ID: ".$user);
                                    $log->error("AMOUNT: ".$amount);
                                    $log->error("post[us_usd]: ".$post['us_usd']);

                                    $status = HistoryCash::create(
                                        $user,
                                        HistoryCash::TRANSFER_TO_BALANCE,
                                        $amount,
                                        "Пополнено на " . $post['us_usd'] . '$'
                                    );

                                    $log->error("Save history cash: ".$status);
                                    $log->error("HISTORY CASH ID FROM DB: ".(string)HistoryCash::findOne(['id' => $status])->user_id);

                                    $messenger = new TelegramApiServices(Yii::$app->params['telegram_api_url']);
                                    $messenger->sendTelegramMessage(Yii::$app->name,
                                        "<b>Новая оплата!</b>\n<b>Сумма: </b>" . $amount . "\n");
                                } else {
                                    throw new \Exception("Order has expired!");
                                }
                            } else {
                                throw new \Exception("Incorrect usd amount! {$order->usd} - {$post['us_usd']}");
                            }
                        } else {
                            throw new \Exception("Order has expired!");
                        }
                    } else {
                        throw new \Exception("Non-existing order!");
                    }
                } else {
                    throw new \Exception("Wrong parameters!");
                }
            } else {
                throw new \Exception("Wrong sign!");
            }

        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

}
