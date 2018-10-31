<?php

namespace backend\modules\accounts\controllers;

use backend\modules\works\models\Works;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;
use common\models\Debug;
use function GuzzleHttp\Psr7\str;
use Yii;
use backend\modules\accounts\models\Accounts;
use backend\modules\accounts\controllers\AccountsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountsController implements the CRUD actions for Accounts model.
 */
class AccountsController extends Controller
{
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
			            'actions' => ['logout', 'index', 'view', 'create', 'update', 'save-works', 'save-acc', 'parse-account', 'parse-works'],
			            'allow' => true,
			            'roles' => ['@'],
		            ],
	            ],
            ],
        ];
    }

    /**
     * Lists all Accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accounts model.
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
     * Creates a new Accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Accounts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
	public function actionParseAccount()
	{
		$model = new Accounts();
		
		return $this->render('_form_acc', [
			'model' => $model,
		]);
	}
	
	public function actionParseWorks()
	{
		$model = new Accounts();
		
		return $this->render('_form_works', [
			'model' => $model,
		]);
	}
    /**
     * Updates an existing Accounts model.
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
    
    public function actionSaveWorks() {
	    $post = Yii::$app->request->post()['Accounts'];
	    if($post['url']) {
		    $works = BehanceService::create(new BehanceAccount($post['url']))->getWorks();
		    if($works) {
			    foreach ($works as $key => $val) {
				    $work_bd = new Works();
				    $work_bd->behance_id = (string)$val->behanceId;
				    $work_bd->image = (string)$val->image;
				    $work_bd->account_id = (integer)$key;
				    $work_bd->url = (string)$val->url;
				    $work_bd->name = (string)$val->name;
				    $work_bd->save();
			    }
			    Yii::$app->session->setFlash('success', "Данные сохранены");
			    return $this->redirect('/admin/accounts/accounts/');
		    }
		    Yii::$app->session->setFlash('error', "Не верный токен!");
		    return $this->redirect('/admin/accounts/accounts/parse-works');
	    }
	    Yii::$app->session->setFlash('error', "Не верно ведены данные!");
	    return $this->redirect('/admin/accounts/accounts/parse-works');
    }
	
	public function actionSaveAcc() {
    	$post = Yii::$app->request->post()['Accounts'];
    	if($post['url']) {
		    $acc = new BehanceAccount($post['url']);
		    if($acc) {
			    if(Accounts::find()->where(['behance_id' => $acc->behanceId])->one()) {
				    Yii::$app->session->setFlash('error', "Данные пользователя уже существуют");
				    return $this->redirect('/admin/accounts/accounts/parse-account');
			    }
			    $acc_bd = new Accounts();
			    $acc_bd->behance_id = (integer)$acc->behanceId;
			    $acc_bd->display_name = (string)$acc->displayName;
			    $acc_bd->username = (string)$acc->username;
			    $acc_bd->url = (string)$acc->url;
			    $acc_bd->image = (string)$acc->image;
			    $acc_bd->save();
			    Yii::$app->session->setFlash('success', "Данные сохранены");
			    return $this->redirect('/admin/accounts/accounts/');
		    }
		    Yii::$app->session->setFlash('error', "Не верный токен!");
		    return $this->redirect('/admin/accounts/accounts/parse-works');
	    }
		Yii::$app->session->setFlash('error', "Не верно ведены данные!");
		return $this->redirect('/admin/accounts/accounts/parse-account');
	}

    /**
     * Deletes an existing Accounts model.
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
     * Finds the Accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('accounts', 'The requested page does not exist.'));
    }
}