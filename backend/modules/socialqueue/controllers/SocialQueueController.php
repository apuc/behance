<?php

namespace backend\modules\socialqueue\controllers;


use backend\modules\socialqueue\models\SocialQueueSearch;
use common\models\SocialQueue;
use common\models\SocialService;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class SocialQueueController
 * @package backend\modules\socialqueue\controllers
 */
class SocialQueueController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SocialQueueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = User::find()->all();
        $users = ArrayHelper::map($users, 'id', 'email');

        $services = SocialService::find()->all();
        $services = ArrayHelper::map($services, 'id', 'title');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'services' => $services,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return SocialQueue|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = SocialQueue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('history-cash', 'The requested page does not exist.'));
    }
}