<?php

namespace backend\modules\vipipsocials\controllers;

use backend\modules\vipipsocials\models\SocialServiceCustomSearch;
use Yii;
use yii\web\Controller;

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
}
