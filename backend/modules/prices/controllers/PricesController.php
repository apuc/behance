<?php

namespace backend\modules\prices\controllers;

use backend\modules\prices\models\FormModel;
use backend\modules\prices\models\Prices;
use backend\modules\settings\models\Settings;
use Yii;
use backend\modules\prices\models\PricesSearch;
use common\models\Proxy;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\clases\ProxyApi;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class PricesController extends Controller
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
        //$searchModel = new PricesSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data_prices = Prices::find()->all();
        $coeff = Settings::findOne(['key' => 'add_coeff']);
        $data = [];
        foreach ($data_prices as $d){
            $data[$d->id] = [];
            $data[$d->id]['key'] = $d->service;
            $data[$d->id]['value'] = $d->price;
            $data[$d->id]['is_setting'] = false;
        }
        $data[$coeff->id] = [];
        $data[$coeff->id]['key'] = $coeff->key;
        $data[$coeff->id]['value'] = $coeff->value;
        $data[$coeff->id]['is_setting'] = true;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id'],
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
        $form = new FormModel();
        $model = $this->findModel($id);
        $exponent = Settings::getSetting('balance_exponent');
        if ($model) {
            $form->key = $model->service;
            $form->value = $model->price / $exponent;
            $form->is_setting = 0;
        } else {
            $model = Settings::findOne(['id' => $id]);
            if ($model) {
                $form->key = $model->key;
                $form->value = $model->value;
                $form->is_setting = 1;
            } else {
                throw new NotFoundHttpException(Yii::t('settings', 'The requested page does not exist.'));
            }
        }

        if ($form->load(Yii::$app->request->post()))
        {
            if ($form->is_setting) {
                $model->key = $form->key;
                $model->value = $form->value;
            } else {
                $model->service = $form->key;
                $model->price = $form->value * $exponent;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash("success", 'Настройка изменена');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prices::findOne($id)) !== null) {
            return $model;
        }

        return null;
    }
}
