<?php

namespace frontend\modules\cabinet\controllers;

use common\models\History;
use common\models\Queue;
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



    public function actionAssignBalance()
    {
        $post = Yii::$app->request->post();

        if(empty($post['likes_work']) && empty($post['views_work']))
        {
            return "Введите количество лайков или просмотров!";
        }

        $user_id = Yii::$app->user->getId();
        $user_balance = Balance::findOne(['user_id'=>$user_id]);

        if($post['likes_work'] > $user_balance->likes)
        {
            return "Не достаточно лайков на балансе!";
        }

        if($post['views_work'] > $user_balance->views)
        {
            return "Не достаточно просмотров на балансе!";
        }

        $queue = new Queue();

        if($queue->load(['Queue'=>$post]) && $queue->save())
        {
           $user_balance->removeFromBalance($post['likes_work'],$post['views_work']);

           History::create($user_id,
               History::TRANSFER_FROM_BALANCE,
               $post['likes_work'],
               $post['views_work'],
               "Лайки и просмотры назначены на работу"
           );

           return true;
        }

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
