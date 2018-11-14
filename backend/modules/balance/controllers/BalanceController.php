<?php

namespace backend\modules\balance\controllers;


use common\models\History;
use common\models\Accounts;
use common\models\User;
use common\models\Balance;
use Yii;
use backend\modules\balance\models\BalanceSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * BalanceController implements the CRUD actions for Balance model.
 */
class BalanceController extends Controller
{
	public $accounts = [];
	public $balance;
    /**
     * {@inheritdoc}
     */


    public function actionIndex()
    {
        $searchModel = new BalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = User::find()->all();
        $users = ArrayHelper::map($users,'id','email');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }



    public function actionAddBalance()
    {
       $post = Yii::$app->request->post();
       $balanceModel = Balance::findOne(['user_id'=>$post['user_id']]);

        if(empty($post['likes']) && empty($post['views']))
        {
            return "Укажите количество лайков или просмотров!";
        }

        $balanceModel->addBalance($post['likes'],$post['views']);

        $historyModel = new History();

        $historyModel->setHistory($post['user_id'],History::TRANSFER_TO_BALANCE,$post['likes'],$post['views'],"Счет пополнен");

        Yii::$app->session->setFlash('success','Баланс пополнен!');
        return true;
    }



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    public function actionCreate()
    {
        $model = new Balance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Balance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('balance', 'The requested page does not exist.'));
    }




}
