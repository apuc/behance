<?php

namespace backend\modules\balancecash\controllers;

use backend\modules\balancecash\models\BalanceCash;
use backend\modules\balancecash\models\BalanceCashSearch;
use common\models\HistoryCash;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class BalanceCashController
 * @package backend\modules\balancecash\controllers
 */
class BalanceCashController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BalanceCashSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = User::find()->all();
        $users = ArrayHelper::map($users, 'id', 'email');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = BalanceCash::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('balance', 'The requested page does not exist.'));
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionAddBalanceCash()
    {
        $post = Yii::$app->request->post();
        $balanceCashModel = BalanceCash::findOne(['user_id' => $post['user_id']]);

        if (empty($post['amount'])) {
            return "Укажите количество средств!";
        }

        $amount = (float)$post['amount'];
        $balanceCashModel->addBalance($amount);

        HistoryCash::create(
            $post['user_id'],
            $amount,
            \common\models\HistoryCash::TRANSFER_TO_BALANCE,
            "Счет пополнен"
        );

        Yii::$app->session->setFlash('success', 'Баланс пополнен!');
        return true;
    }

    /**
     * Снятие с баланса
     * @return bool|string
     */
    public function actionWithdrawBalanceCash()
    {
        $post = Yii::$app->request->post();
        $balanceCashModel = BalanceCash::findOne(['user_id' => $post['user_id_withdraw']]);


        if (empty($post['amount'])) {
            return "Укажите количество средств!";
        }

        $amount = (float)$post['amount'];

        $balanceCashModel->withdrawBalance($amount);

        HistoryCash::create(
            $post['user_id_withdraw'],
            $amount,
            \common\models\HistoryCash::TRANSFER_FROM_BALANCE,
            "Средства сняты со счета"
        );

        Yii::$app->session->setFlash('warning', 'Средства сняты с баланса!');
        return true;
    }
}
