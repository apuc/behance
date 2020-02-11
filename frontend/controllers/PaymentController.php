<?php

namespace frontend\controllers;

use common\models\BalanceCash;
use common\models\HistoryCash;
use common\models\OrdersCash;
use common\models\Settings;
use DateTime;
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
                    'payment-results' => ['post'],
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

        try
        {
            $curr_date = new DateTime(date("Y-m-d H:i:s"));

            $parameters =[':date'=> $curr_date, ':log_text' => ''];
            $sql = 'INSERT INTO log(date, log_text) VALUES (:date, :log_text)';
            $cmnd = Yii::$app->db->createCommand($sql);

            $post = Yii::$app->request->post();
            $sign = FreeCassa::generateSign($post['AMOUNT'],FreeCassa::SECRET_2, $post['MERCHANT_ORDER_ID']);

            if ($sign == $post['SIGN'])
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
                        $parameters[':log_text'] = "Entered us_usd";
                        $cmnd->bindParam(':date', $parameters[':date']);
                        $cmnd->bindParam(':log_text', $parameters[':log_text']);
                        $cmnd->execute();
                        $is_correct_amount = $order->amount == $post['AMOUNT'];
                        $is_correct_usd = strcmp(strval($order->usd), $post['us_usd']);
                        $order_date = new \DateTime($order->date);
                        $expire_days = intval(Settings::getSetting('expiration_days'));
                        $is_still_valid = $curr_date->diff($order_date)->days < $expire_days;
                        if ($is_correct_amount) {
                            if ($is_correct_usd) {
                                if ($is_still_valid) {
                                    $parameters[':log_text'] = "Should be fine";
                                    $cmnd->bindParam(':date', $parameters[':date']);
                                    $cmnd->bindParam(':log_text', $parameters[':log_text']);
                                    $cmnd->execute();
                                    $balance = BalanceCash::findOne(['user_id' => $user]);
                                    $exponent = intval(Settings::getSetting('balance_exponent'));
                                    $amount = $post['us_usd'] * $exponent;
                                    $balance->addBalance($amount);
                                    $order->is_paid = 1;
                                    $order->save();
                                    HistoryCash::create(
                                        $user,
                                        HistoryCash::TRANSFER_TO_BALANCE,
                                        $amount,
                                        "Пополнено на " . $post['us_usd'] . '$'
                                    );
                                } else {
                                    $parameters[':log_text'] = "Order has expired!";
                                    $cmnd->bindParam(':date', $parameters[':date']);
                                    $cmnd->bindParam(':log_text', $parameters[':log_text']);
                                    $cmnd->execute();
                                    throw new \Exception("Order has expired!");
                                }
                            } else {
                                $parameters[':log_text'] = "Incorrect usd amount! {$post['us_usd']}";
                                $cmnd->bindParam(':date', $parameters[':date']);
                                $cmnd->bindParam(':log_text', $parameters[':log_text']);
                                $cmnd->execute();
                                throw new \Exception("Incorrect usd amount!");
                            }
                        } else {
                            $parameters[':log_text'] = "Incorrect rub amount! {$post['AMOUNT']}";
                            $cmnd->bindParam(':date', $parameters[':date']);
                            $cmnd->bindParam(':log_text', $parameters[':log_text']);
                            $cmnd->execute();
                            throw new \Exception("Order has expired!");
                        }
                    } else {
                        $parameters[':log_text'] = "Non-existing order! {$post['MERCHANT_ORDER_ID']}";
                        $cmnd->bindParam(':date', $parameters[':date']);
                        $cmnd->bindParam(':log_text', $parameters[':log_text']);
                        $cmnd->execute();
                        throw new \Exception("Non-existing order!");
                    }
                } else {
                    $parameters[':log_text'] = "Wrong parameters!";
                    $cmnd->bindParam(':date', $parameters[':date']);
                    $cmnd->bindParam(':log_text', $parameters[':log_text']);
                    $cmnd->execute();
                    throw new \Exception("Order has expired!");
                    throw new \Exception("Wrong parameters!");
                }
            } else {
                $parameters[':log_text'] = "Wrong sign! {$post['SIGN']}" ;
                $cmnd->bindParam(':date', $parameters[':date']);
                $cmnd->bindParam(':log_text', $parameters[':log_text']);
                $cmnd->execute();
                throw new \Exception("Wrong sign!");
            }

        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

}
