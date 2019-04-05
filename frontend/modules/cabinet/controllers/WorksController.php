<?php

namespace frontend\modules\cabinet\controllers;

use common\models\History;
use common\models\Queue;
use common\models\forms\AssignBalanceForm;
use frontend\modules\cabinet\models\Balance;
use Yii;
use frontend\modules\cabinet\models\Works;
use frontend\modules\cabinet\models\WorksSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * WorksController implements the CRUD actions for Works model.
 */
class WorksController extends Controller
{
    /**
     * Lists all Works models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $works = Works::find()->with('account')->where($dataProvider->query->where)->all();
        $works_names = ArrayHelper::map($works,'name','name');
        $account_names = array();

        foreach ($works as $w)
        {
            $account_names[$w->account_id] = $w->account['display_name'];
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'works_names'=>$works_names,
            'account_names'=>$account_names
        ]);
    }

    /**
     * Добавление в очередь
     * @return bool|string
     */
    public function actionAssignBalance()
    {
        $form = new AssignBalanceForm(Yii::$app->request->post());
        $userId = Yii::$app->user->getId();

        if(!$form->validate()){
            return $form->getFirstErrors()['error'];
        }

        $count = intdiv($form->views,Queue::MAX_VIEWS);
        $leftViews = $form->views % Queue::MAX_VIEWS;

        if($count == 0){
            $count =1;
            $leftViews = 0;
        }

        for($i = 0; $i < $count; $i++)
        {
            $views = ($form->views > Queue::MAX_VIEWS) ? Queue::MAX_VIEWS : $form->views;
            $likes = ($i == 0) ? $form->likes : 0;
            Queue::create($form->workId,$likes,$views);
        }

        if($leftViews != 0){
            Queue::create($form->workId,0,$leftViews);
        }

        $userBalance = Balance::findOne(['user_id'=>$userId]);
        $userBalance->removeFromBalance($form->likes,$form->views);

        History::create($userId,
            History::TRANSFER_FROM_BALANCE,
            $form->likes,
            $form->views,
            "Лайки и просмотры назначены на работу"
        );

        return true;
    }

    /**
     * Displays a single Works model.
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
     * Creates a new Works model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Works();
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
     * Updates an existing Works model.
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
     * Deletes an existing Works model.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Works model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Works the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Works::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('works', 'The requested page does not exist.'));
    }
}
