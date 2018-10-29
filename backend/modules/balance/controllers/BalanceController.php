<?php

namespace backend\modules\balance\controllers;

use common\models\Debug;
use common\models\User;
use Yii;
use backend\modules\balance\models\Balance;
use backend\modules\balance\controllers\BalanceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BalanceController implements the CRUD actions for Balance model.
 */
class BalanceController extends Controller
{
	public $data = [];
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
			            'actions' => ['logout', 'index', 'view', 'create', 'update'],
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
        $searchModel = new BalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
    public function actionCreate()
    {
        $model = new Balance();
        
        foreach (User::find()->all() as $user){
        	$this->data[$user->id] = $user->username;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'data' => $this->data,
        ]);
    }

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
	    
        $this->data[$model->user_id] = User::findOne($model->user_id)->username;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'data' => $this->data,
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
