<?php

namespace frontend\controllers;

use Yii;
use common\models\Cases;
use common\models\Balance;
use common\models\History;
use common\clases\FreeCassa;
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
            $post = Yii::$app->request->post();

            $sign = FreeCassa::generateSign($post['AMOUNT'],FreeCassa::SECRET_2, $post['MERCHANT_ORDER_ID']);

            if ($sign == $post['SIGN'])
            {
                $user = $post['us_userid'];

                $case = Cases::findOne(['id' => $post['us_caseid']]);

                if ($post['AMOUNT'] == $case->price)
                {
                    $balance = Balance::findOne(['user_id' => $user]);
                    $balance->addBalance($case->likes, $case->views);

                    History::create(
                        $user,
                        History::TRANSFER_TO_BALANCE,
                        $case->likes,
                        $case->views,
                        "Применен пакет {$case->name}!"
                    );
                }

                throw new \Exception("Wrong amount!");

            }

            throw new \Exception("Wrong sign!");

        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

}
