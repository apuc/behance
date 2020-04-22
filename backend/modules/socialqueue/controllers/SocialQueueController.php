<?php

namespace backend\modules\socialqueue\controllers;


use backend\modules\socialqueue\models\SocialQueueSearch;
use common\models\Settings;
use common\models\Social;
use common\models\SocialQueue;
use common\models\SocialService;
use common\models\User;
use VipIpRuClient\Enum\StatusType;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

    private function getWrapper($id) {
        $type = SocialService::findOne(['type_id' => $id]);
        $social = Social::findOne(['id' => $type->id_soc]);
        $class = "VipIpRuClient\\".ucfirst($social->soc_code).'Wrapper';
        return new $class(Settings::getSetting('access_token'));
    }

    // PJAX for refresh
    public function actionRefresh($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $model = $this->findModel($id);
                $wrapper = $this->getWrapper($model->type_id);
                $status = $wrapper->getJob($model->link_id);
                if ($status == 1) {
                    $model->status = $wrapper->getJobStatus()->getValue() == StatusType::ENABLED()->getValue() ? 1 : 0;
                    $model->balance = $wrapper->getJobBalance();
                    if ($model->status == 0 && $model->balance > 0){
                        $model->status = 2;
                    }
                    if ($model->save()) {
                        return ['success' => true];
                    }
                    return ['success' => false, 'error' => 'Не получилось обновить статус, попробуйте повторить позднее'];
                }
                return ['success' => false, 'error' => 'Не получилось обновить статус, попробуйте повторить позднее'];
            }
            catch (NotFoundHttpException $e) {

            }
        }
    }

    // PJAX for turn on
    public function actionTurnOn($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $model = $this->findModel($id);
                $wrapper = $this->getWrapper($model->type_id);
                $status = $wrapper->getJob($model->link_id);
                if ($status == 1) {
                    if ($wrapper->getJobBalance() > 0) {
                        $model->status = 1;
                        $status = $wrapper->setJobStatus(StatusType::ENABLED()->getValue());
                        if ($status == 1 && $model->save()) {
                            return ['success' => true];
                        }
                    } else {
                        $model->status = $wrapper->getJobStatus()->getValue() == StatusType::ENABLED()->getValue() ? 1 : 0;
                        $model->balance = $wrapper->getJobBalance();
                        if ($model->save()) {
                            return ['success' => true];
                        }
                    }
                    return ['success' => false, 'error' => 'Не получилось изменить статус, попробуйте повторить позднее'];
                }
            }
            catch (NotFoundHttpException $e) {

            }
        }
    }

    // PJAX for turn on
    public function actionTurnOff($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $model = $this->findModel($id);
                $wrapper = $this->getWrapper($model->type_id);
                $status = $wrapper->getJob($model->link_id);
                if ($status == 1) {
                    $model->status = 2;
                    $model->balance = $wrapper->getJobBalance();
                    $status = $wrapper->setJobStatus(StatusType::DISABLED()->getValue());
                    if ($status == 1 && $model->save()) {
                        return ['success' => true];
                    }
                    return ['success' => false, 'error' => 'Не получилось изменить статус, попробуйте повторить позднее'];
                }
            }
            catch (NotFoundHttpException $e) {

            }
        }
    }
}