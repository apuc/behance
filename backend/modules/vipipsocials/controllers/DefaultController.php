<?php

namespace backend\modules\vipipsocials\controllers;

use backend\modules\vipipsocials\models\SocialsServices;
use common\models\SocialService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\modules\vipipsocials\models\SocialServiceCustomSearch;
use Yii;

/**
 * Default controller for the `vipipsocials` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SocialServiceCustomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = SocialsServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system_title', 'The requested page does not exist.'));
    }
}
