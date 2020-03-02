<?php

namespace frontend\modules\cabinet\controllers;

use common\classes\SendMail;
use common\models\BalanceCash;
use common\models\HistoryCash;
use common\models\Settings;
use common\models\Social;
use common\models\SocialService;
use frontend\modules\cabinet\models\SocialQueueForm;
use VipIpRuClient\Enum\BalanceType;
use VipIpRuClient\Enum\StatusType;
use VipIpRuClient\SocialWrapper;
use VipIpRuClient\VkWrapper;
use Yii;
use common\models\SocialQueue;
use frontend\modules\cabinet\models\SocialQueueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SocialQueueController implements the CRUD actions for SocialQueue model.
 */
class SocialQueueController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all SocialQueue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SocialQueueSearch();
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['user_id'] = Yii::$app->user->id;
        $dataProvider = $searchModel->search($params);

        $services = $this->getSocialServices();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'services' => $services
        ]);
    }

    /**
     * Displays a single SocialQueue model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        //return $this->render('view', [
        //    'model' => $this->findModel($id),
        //]);
        $this->redirect('index');
    }

    /**
     * Creates a new SocialQueue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $social
     * @param null $service
     * @return mixed
     */
    public function actionCreate($social = null, $service = null)
    {
        $model = new SocialQueueForm();
        if ($model->gender == null) $model->gender = '-';
        if ($model->age_min == null) $model->age_min = 0;
        if ($model->age_max == null) $model->age_max = 0;
        if ($model->friends_id == null) $model->friends_id = 0;
        if ($model->balance == null) $model->balance = 1;
        if ($model->price == null) $model->price = 0;
        $error = null;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $balance_cash = BalanceCash::findOne(['user_id'=>Yii::$app->user->getId()]);
                $balance_cash->amount = intval($balance_cash->amount);
                $model->price = intval($model->price);

                $actual_model = new SocialQueue();
                $wrapper = new SocialWrapper(Settings::getSetting('access_token'));
                $session = Yii::$app->session;
                $error = "Произошла ошибка при создании задачи, пожалуйста введите параметры ещё раз<br>Введенная в прошлый раз вами ссылка - $model->link";
                if (isset($session['inputs']) && isset($session['price'])) {
                    $inputs = $session['inputs'];

                    // TODO: add more checks? like balance > 0 and etc
                    if ($model->price > $balance_cash->amount) {
                        $error = "Недостаточно денег на счету для создания задачи накрутки<br>Введенная в прошлый раз вами ссылка - $model->link";
                    } else {
                        $result = $this->setParamsWrapper($inputs, $model);

                        if($result['all_good']) {
                            $user = Yii::$app->user->id;
                            $date = date('Y-m-d H-i-s');

                            $status = $wrapper->createJob('Job - user-'.$user.' - '.$date, $model->type_id, $result['params']);
                            if ($status == 1) {
                                $status = $wrapper->setJobBalance($model->balance, BalanceType::VIEWS()->getValue());
                                if ($status == 1) {
                                    // TODO: rewrite mb to never account error from set job status when there is no money in api account
                                    $status = $wrapper->setJobStatus(StatusType::ENABLED()->getValue());
                                    if ($status == 1) {
                                        $actual_model->status = 1;
                                    }
                                    else {
                                        //$wrapper->deleteCurrentJob();
                                        //and error
                                        $actual_model->status = 0;
                                    }
                                    $actual_model->link_id = $wrapper->getLinkId();
                                    $actual_model->user_id = $user;
                                    $actual_model->dt_add = $date;
                                    $actual_model->type_id = $model->type_id;
                                    $actual_model->url = $model->link;
                                    $actual_model->balance = $model->balance;
                                    $status = $actual_model->save();
                                    HistoryCash::create(
                                        $user,
                                        HistoryCash::TRANSFER_FROM_BALANCE,
                                        $model->price,
                                        'Снятие денег за услуг накрутки №'.$actual_model->id);
                                    $balance_cash->removeFromBalance($model->price);
                                    $this->redirect(['index']);
                                } else {
                                    $wrapper->deleteCurrentJob();
                                    // default error will be used if Job couldn't be created
                                    // will pretty much be spammin 'till someone adds funds
                                    $this->sendBalanceEmail(Settings::getSetting('balance_handler_email'));
                                }
                            }
                            // default error will be used if Job couldn't be created
                        }
                        else {
                            $error = 'Возникли следующие ошибки:<br>'.$result['error'];
                        }
                    }
                } else {
                    $error = "Произошла неизвестная ошибка, пожалуйста введите параметры ещё раз<br>Введенная в прошлый раз вами ссылка - $model->link";
                }
            }
        }
        $model->social = null;
        $model->type_id = null;
        $socials = $this->getSocials();
        $options = $this->getFriendsOptions();
        $services = $this->getSocialServices();
        if (isset($socials[$social])) {
            $model->social = $social;
            if (isset($services[$service])) {
                $model->type_id = $service;
            }
        }
        return $this->render('create', [
            'model' => $model,
            'socials' => $socials,
            'friends_options' => $options['friends_options'],
            'friends_prices' => $options['friends_prices'],
            'errors' => $error,
        ]);
    }

    private function sendBalanceEmail($email) {
        SendMail::create()->setSMTPConfig(Yii::$app->params['smtp-config'])
            ->addAddress($email)
            ->setSubject('Behance Space - проблема с балансом на VipIP')
            ->setBody("<p>Не хватает средств на привязаном к Behance Space VipIP-аккаунте. Срочно пополните баланс</p>")
            ->setFrom(Yii::$app->params['smtp-config']['username'], 'BS')
            ->isHTML()
            ->send();
    }

    /**
     * @param $inputs array contains strings of needed variables
     * @param $model SocialQueueForm form with values
     */
    private function setParamsWrapper($inputs, $model)
    {
        $all_good = true;
        $error = '';
        if (in_array('link', $inputs)) {
            if (empty($model->link)) {
                $all_good = false;
                $error .= 'Ссылка пуста<br>';
            }
            else {
                $link = $model->link;
            }
        }
        if (in_array('msg', $inputs)) {
            if (empty($model->msg)) {
                $all_good = false;
                $error .= 'Текст поста пуст<br>';
            }
            else {
                $msg = $model->msg;
            }
        }
        if (in_array('gender', $inputs)) {
            if (empty($model->gender)) {
                $gender = '';
            }
            else {
                $gender = $model->gender;
                if ($gender == '-') {
                    $gender = '';
                }
            }
        }
        if (in_array('age', $inputs)) {
            $age_min = empty($model->age_min) ? 0 : $model->age_min;
            $age_max = empty($model->age_max) ? 0 : $model->age_max;
            if ($age_min > $age_max) {
                $temp = $age_max;
                $age_max = $age_min;
                $age_min = $temp;
            }
        }
        if (in_array('friends', $inputs)) {
            if (empty($model->friends)) {
                $friends = 0;
            } else {
                $friends = $model->friends;
            }
        }
        if (in_array('answer', $inputs)) {
            if (empty($model->answer_id)) {
                $all_good = false;
                $error .= 'Ответ к голосванию не был предоставлен<br>';
            } else {
                $answer = $model->answer_id;
            }
        }
        return [
            'error' => $error,
            'all_good' => $all_good,
            'params' => [
                'url' => isset($link) ? $link : null,
                'message' => isset($msg) ? $msg : null,
                'gender' => isset($gender) ? $gender : null,
                'age_min' => isset($age_min) ? $age_min : null,
                'age_max' => isset($age_max) ? $age_max : null,
                'friends' => isset($friends) ? $friends : null,
                'answerid' => isset($answer) ? $answer : null,
                'balance' => $model->balance
            ],
        ];
    }

    private function getSocials()
    {
        $socials = [];
        foreach (Social::find()->all() as $social)
        {
            $socials[$social->id] = $social->name;
        }
        return $socials;
    }

    private function getSocialServices() {
        $services_obj = SocialService::find()->orderBy(['id_soc' => SORT_ASC])->all();
        $services = [];
        foreach ($services_obj as $service) {
            $services[$service->type_id] = $service->title;
        }
        return $services;
    }

    private function getFriendsOptions()
    {
        $friends_options = [];
        $friends_prices = [];
        foreach (SocialWrapper::getSocialOptions()->friends as $option)
        {
            $key = $option->friends;
            $value = $option->title;
            $price = $option->pricecoeff;
            $friends_options[$key] = $value;
            $friends_prices[$key] = $price;
        }
        return ['friends_options' => $friends_options, 'friends_prices' => $friends_prices];
    }

    /**
     * Updates an existing SocialQueue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //$model = $this->findModel($id);
//
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //    return $this->redirect(['view', 'id' => $model->id]);
        //}
//
        //return $this->render('update', [
        //    'model' => $model,
        //]);
        $this->redirect('index');
    }

    /**
     * Deletes an existing SocialQueue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
//
        //return $this->redirect(['index']);
        $this->redirect('index');
    }

    /**
     * Finds the SocialQueue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SocialQueue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SocialQueue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateGetServices()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $selected_services = SocialService::find()->where(['id_soc' => $data['id_soc'], 'status' => 1])->all();
            $response = [];
            foreach ($selected_services as $service)
            {
                $response["$service->type_id"] = $service->title;
            }
            return [
                'code' => 200,
                'data' => $response
            ];
        }
        return [
            'code' => 100,
        ];
    }

    public function actionCreateGetFields()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $service = SocialService::findOne(['type_id' => $data['type_id']]);
            if ($service) {
                $inputs = explode(';', $service->inputs);
                $coeff = Settings::findOne(['key' => 'add_coeff'])->value;
                $price = strval(round(($service->price * floatval($coeff)) / (1000000 * 1000), 4));
                $session = Yii::$app->session;
                $session['inputs'] = $inputs;
                $session['price'] = $service->price;
                return [
                    'code' => 200,
                    'inputs' => $inputs,
                    'price' => $price
                ];
            }
        }
        return [
            'code' => 100,
        ];
    }

    public function actionCreateGetAnswers()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (filter_var($data['link'],FILTER_VALIDATE_URL)) {
                $poll = VkWrapper::getPollAnswers($data['link']);
                if (isset($temp_answers->error)) {
                    return [
                        'code' => 100,
                        'msg' => 'Неправильная ссылка'
                    ];
                }
                $answers = [];
                foreach ($poll->answers as $answer) {
                    $answers[$answer->id] = $answer->text;
                }
                return [
                    'code' => 200,
                    'answers' => $answers,
                    'title' => $poll->question
                ];
            } else {
                return [
                    'code' => 100,
                    'msg' => 'Неправильная ссылка'
                ];
            }
        }
        return [
            'code' => 100,
            'msg' => 'Неправильный запрос'
        ];
    }

    /**
     * @param $id
     * @return SocialWrapper
     */
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
                    $model->status = 0;
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
