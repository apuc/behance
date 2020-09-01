<?php

namespace frontend\modules\cabinet\controllers;

use common\models\Works;
use Yii;
use common\models\Accounts;
use frontend\modules\cabinet\models\AccountsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;
use yii\filters\AccessControl;
use common\behance\lib\BehanceAccountException;

/**
 * AccountsController implements the CRUD actions for Accounts model.
 */
class AccountsController extends Controller
{


    /**
     * Lists all Accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $accounts = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->all();
        $display_names = ArrayHelper::map($accounts,'display_name','display_name');


        $user_names = ArrayHelper::map($accounts,'username','username');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'display_names'=>$display_names,
            'usernames'=>$user_names
        ]);
    }



    public function actionParse($url)
    {
        try
        {
            $worksModel = new Works();
            $service =BehanceService::create(new BehanceAccount());
            $service->getAccount($url);
            $res = $worksModel->parseWorks($service,true);

            Yii::$app->session->setFlash('success',"Добавленно работ: {$res}");
            return $this->redirect('/cabinet/accounts');
        }
        catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error',$e->getMessage());
            return $this->redirect('/cabinet/accounts');
        }
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
        $accountModel = new Accounts();

        if(Yii::$app->request->post())
        {

            $url = Yii::$app->request->post()['Accounts']['url'];

            try
            {
                $service = BehanceService::create(new BehanceAccount());
                $service->getAccount($url);
                $accountModel->parseAccount($service);

                $worksModel = new Works();
                $worksModel->parseWorks($service);

                Yii::$app->session->setFlash('success','Аккаунт получен! Работы добавленны!');
                return $this->redirect('/cabinet/accounts');
            }
            catch (\Exception $e)
            {
                Yii::$app->session->setFlash('error',$e->getMessage());
                return $this->redirect('/cabinet/accounts');
            }

        }

        return $this->render('create', [
            'model' => $accountModel,
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
