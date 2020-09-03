<?php

namespace backend\modules\historycash\controllers;

use backend\modules\historycash\models\HistoryCashSearch;
use common\models\User;
use Yii;
use common\models\HistoryCash;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class HistoryCashController
 * @package backend\modules\history-cash\controllers
 */
class HistoryCashController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HistoryCashSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = User::find()->all();
        $users = ArrayHelper::map($users,'id','email');

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return HistoryCash|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = HistoryCash::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('history-cash', 'The requested page does not exist.'));
    }
}
