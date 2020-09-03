<?php

namespace backend\modules\support\controllers;

use backend\modules\support\models\SupportSearch;
use common\models\SupportAnswers;
use common\models\SupportQuestions;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class SupportController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SupportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = User::find()->all();
        $users = ArrayHelper::map($users, 'id', 'email');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model0 = new SupportAnswers();
        if ($model0->load(Yii::$app->request->post())) {
            $model0->question_id = $id;
            $model0->status = 1;
            $model1 = $this->findModel($id);
            $model1->status = 2;
            $model1->save();
            $model0->save();
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model0' => $model0,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->status = 3;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionOpen($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return SupportQuestions|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = SupportQuestions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('history-cash', 'The requested page does not exist.'));
    }

}