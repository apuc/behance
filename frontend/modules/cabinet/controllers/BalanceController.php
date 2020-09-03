<?php

namespace frontend\modules\cabinet\controllers;

use common\models\Accounts;
use common\models\Debug;
use common\models\History;
use Yii;
use frontend\modules\cabinet\models\Balance;
use frontend\modules\cabinet\models\SearchBalance;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BalanceController implements the CRUD actions for Balance model.
 */
class BalanceController extends Controller
{

	public $account;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
	            'class' => AccessControl::className(),
	            'rules' => [
		            [
			            'actions' => ['login', 'error'],
			            'allow' => true,
		            ],
		            [
			            'actions' => ['logout', 'index','history'],
			            'allow' => true,
			            'roles' => ['@'],
		            ],
	            ],
            ],
        ];
    }

    /**
     * Lists all Balance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBalance();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$this->account = Accounts::findOne(['user_id'=>Yii::$app->user->identity->id]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'account' => $this->account,
        ]);
    }
    
    public function actionHistory($slug) {
        if(is_numeric($slug)) {
        	$history = History::find()->where(['accounts_id' => $slug])->all();
        	$account = Accounts::findOne(['id' => $slug]);
        	return $this->render('_history',['history' => $history, 'account' => $account ]);
        } else {
	        $history = History::find()->all();
	        return $this->render('_history',['history' => $history , 'account' => Yii::t('balance', 'All operations') ]);
        }
    }

    /**
     * Displays a single Balance model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Balance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Balance();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing Balance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Balance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $history = new History();
        $history->delBalance(Balance::findOne(['id'=>$id])->accounts_id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Balance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Balance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Balance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('balance', 'The requested page does not exist.'));
    }
}
