<?php

namespace backend\modules\balancecash\controllers;

use backend\modules\balancecash\models\BalanceCash;
use backend\modules\balancecash\models\BalanceCashSearch;
use backend\modules\historycash\models\HistoryCash;
use common\models\History;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `balancecash` module
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

    public function actionAddBalance()
    {
        $post = Yii::$app->request->post();
        $balanceCashModel = BalanceCash::findOne(['user_id' => $post['user_id']]);

        if (empty($post['amount'])) {
            return "Укажите количество средств!";
        }

        $balanceCashModel->addBalance($post['amount']);

        HistoryCash::create(
            $post['user_id'],
            \common\models\HistoryCash::TRANSFER_TO_BALANCE,
            $post['amount'],
            "Счет пополнен"
        );

        Yii::$app->session->setFlash('success', 'Баланс пополнен!');
        return true;
    }
}
