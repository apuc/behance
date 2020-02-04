<?php

namespace frontend\modules\cabinet\controllers;

use common\models\BalanceCash;
use common\models\Social;
use common\models\SocialService;
use frontend\modules\cabinet\models\SocialQueueForm;
use VipIpRuClient\SocialWrapper;
use VipIpRuClient\VkWrapper;
use Yii;
use common\models\SocialQueue;
use frontend\modules\cabinet\models\SocialQueueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SocialQueue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // TODO: add error banner to view
        $model = new SocialQueueForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // TODO: saving proper
                // TODO: empty fields validation
                $balance_cash = BalanceCash::find()->where(['user_id'=>Yii::$app->user->getId()])->one();
                $actual_model = new SocialQueue();
                $wrapper = new SocialWrapper(Yii::$app->params['access_token']);
                $session = Yii::$app->session;
                if (isset($session['inputs']) && isset($session['price'])) {
                    $inputs = $session['inputs'];
                    $price = $session['price'];

                    $result = $this->setParamsWrapper($inputs, $model);

                    if($result['all_good']) {
                        $user = Yii::$app->user->id;
                        $date = date('d-m-Y');
                        $status = $wrapper->createJob('Job - user-'.$user.'-'.$date, $model->type_id, $result['params']);
                        if ($status == 1) {
                            // TODO: actual saving
                            $this->redirect(['index']);
                        } else {
                            // TODO: redirect with error to create
                        }
                    }
                } else {
                    // TODO: redirect with error to create
                }
            }
        }
        $socials = [];
        foreach (Social::find()->all() as $social)
        {
            $socials[$social->id] = $social->name;
        }

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

        $model->gender = '-';
        $model->age_min = 0;
        $model->age_max = 0;
        $model->friends_id = 0;
        $model->balance = 1;

        return $this->render('create', [
            'model' => $model,
            'socials' => $socials,
            'friends_options' => $friends_options,
            'friends_prices' => $friends_prices
        ]);
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
                $error .= 'Ссылка пуста';
            }
            else {
                $link = $model->link;
            }
        }
        if (in_array('msg', $inputs)) {
            if (empty($model->msg)) {
                $all_good = false;
                $error .= 'Текст поста пуст';
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
                $error .= 'Ответ к голосванию не был предоставлен';
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
            ],
        ];
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $service = SocialService::findOne(['type_id' => $data['type_id']]);
            if ($service) {
                $inputs = explode(';', $service->inputs);
                $price = strval(round($service->price / (1000000 * 1000), 4));
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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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
}
