<?php

namespace backend\modules\settings\controllers;

use Yii;
use common\models\Settings;
use backend\modules\settings\models\SettingsSearch;
use common\models\Proxy;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SeoController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Settings::find()->where(['like', 'key', 'seo']),
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }





    /**
     * Displays a single Settings model.
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
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model= new Settings();

        if (Yii::$app->request->post())
        {
            Settings::createSeoSetting(Yii::$app->request->post());
            Yii::$app->session->setFlash("success",'Страница добавлена');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'create'=>true
        ]);
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $setting = $this->findModel($id);

        if (Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            unset($post['_csrf-backend']);

            $setting->value = json_encode($post);
            $setting->save(false);

            Yii::$app->session->setFlash("success",'Сохранено!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $setting,
        ]);
    }

    /**
     * Deletes an existing Settings model.
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
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('settings', 'The requested page does not exist.'));
    }
}
