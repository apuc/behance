<?php

namespace backend\modules\queue\controllers;

use common\models\Works;
use Yii;
use backend\modules\queue\models\Queue;
use backend\modules\queue\models\QueueSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QueueController implements the CRUD actions for Queue model.
 */
class QueueController extends Controller
{
    /**
     * Lists all Queue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QueueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $works = $this->getWorksNames();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'works' => $works,
        ]);
    }

    /**
     * Displays a single Queue model.
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
     * Creates a new Queue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Queue();

        $works = $this->getWorksNames(true);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $work = Works::findOne($model->work_id);
            $work->getCurrentStats();
            $work->save();

            Yii::$app->session->setFlash('success','Работа добавлена');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'works' => $works,
        ]);
    }

    /**
     * Updates an existing Queue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success','Изменения сохранены');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Queue model.
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
     * Finds the Queue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Queue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Queue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('queue', 'The requested page does not exist.'));
    }

    /**
     * @param bool $excludeQueue
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getWorksNames($excludeQueue = false)
    {
        if($excludeQueue)
        {
            $worksQueue = Queue::find()->select('work_id')->all();
            $worksQueue = ArrayHelper::getColumn($worksQueue,'work_id');
            $worksQueue = implode(',',$worksQueue);

            if(empty($worksQueue)){
                $worksQueue = 0;
            }

            $works = Works::find()->where("id NOT IN({$worksQueue})")->all();
            $works = ArrayHelper::map($works,'id','name');

            return $works;
        }

        $works = Works::find()->all();
        $works = ArrayHelper::map($works,'id','name');

        return $works;
    }
}
