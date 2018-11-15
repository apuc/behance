<?php

namespace frontend\modules\cabinet\controllers;

use Yii;
use common\models\History;
use frontend\modules\cabinet\models\HistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class HistoryController extends Controller
{


    public function actionIndex()
    {
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    protected function findModel($id)
    {
        if (($model = History::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
