<?php

namespace backend\modules\accounts\controllers;

use backend\modules\works\models\Works;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;
use common\models\Debug;
use common\models\User;
use function GuzzleHttp\Psr7\str;
use Yii;
use backend\modules\accounts\models\Accounts;
use backend\modules\accounts\models\AccountsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;




class AccountsController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actionIndex()
    {
        $searchModel = new AccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $acc = Accounts::find()->all();
        $display_names = ArrayHelper::map($acc,'display_name','display_name');

        $users = User::find()->all();
        $users = ArrayHelper::map($users,'id','email');
	    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'display_names' => $display_names,
        ]);
    }


    public function actionParseAccount()
    {
        $accountsModel = new Accounts();

        if(Yii::$app->request->post())
        {
            $url = Yii::$app->request->post()['Accounts']['url'];
            $user_id = Yii::$app->request->post()['Accounts']['user_id'];

            try
            {
                $service = BehanceService::create(new BehanceAccount());
                $service->getAccount($url);

                $accountsModel->parseAccount($service,$user_id);

                Yii::$app->session->setFlash('success', "Аккаунт получен!");
                return $this->redirect('/admin/accounts/accounts/');
            }
            catch (\Exception $e)
            {
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->redirect('/admin/accounts/accounts/parse-account');
            }
        }

        $users = User::find()->asArray()->all();
        $users = ArrayHelper::map($users,'id','email');

        return $this->render('_form_acc', [
            'model' => $accountsModel,
            'users' => $users,
        ]);
    }



    public function actionParseWorks()
    {
        $model = new Accounts();

        $accounts = Accounts::find()->asArray()->all();
        $accounts = ArrayHelper::map($accounts,'url','display_name');

        if(Yii::$app->request->post())
        {
            $url = Yii::$app->request->post()['account'];

            try
            {
                $worksModel = new Works();
                $service = BehanceService::create(new BehanceAccount());
                $service->getAccount($url);
                $worksModel->parseWorks($service,true);

                Yii::$app->session->setFlash('success', "Работы добавленны!");
                return $this->redirect('/admin/accounts/accounts/');

            }
            catch (\Exception $e)
            {
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->redirect('/admin/accounts/accounts/parse-works');
            }

        }

        return $this->render('_form_works', [
            'model' => $model,
            'accounts' => $accounts,
        ]);
    }



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



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



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('accounts', 'The requested page does not exist.'));
    }
}
