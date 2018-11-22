<?php
namespace frontend\controllers;


use common\models\Accounts;
use common\models\Balance;
use common\models\Cases;
use common\models\Debug;
use common\models\Declensions;
use common\models\History;
use common\models\Reviews;
use common\models\Works;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use \common\models\ContactForm;
use common\models\Proxy;
use common\behance\lib\BehanceAccount;
use common\behance\BehanceService;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
	    $reviews = Reviews::find()->all();
	    $cases = Cases::find()->where(['!=', 'status', 0])->orderBy('price')->all();
        
        return $this->render('index', ['reviews' => $reviews, 'cases' => $cases]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goHome();
        }

        $model->password = '';

        return $this->render('login', [
                'model' => $model,
        ]);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



    public function actionContact()
    {

        $form = new ContactForm();
        $post['ContactForm'] = Yii::$app->request->post();
        $response = array();

        if ($form->load($post) && $form->validate())
        {
            $form->save(false);
            $response['message']='Ваша заявка принята!';
            $response['status']='ok';

        }
        else
        {
            $response['message']='Ошибка! Введите корректные данные!';
            $response['status']='error';
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return json_encode($response);
    }



    public function actionCallback()
    {
        echo "Cпасибо! Мы вам перезвоним!";
    }



    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {

                if($hash = Yii::$app->request->get('ref'))
                {
                    if($referer = $user::findOne(['ref_hash'=>$hash]))
                    {
                        $referer_balance = Balance::findOne(['user_id'=>$referer->id]);
                        $referer_balance->addBalance(100,0);
                        $history = new History();
                        $history->setHistory($referer->id,History::TRANSFER_TO_BALANCE,100,0,"Начислено 100 лайков регестрацию по реферальной ссылке");
                    }
                }

                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());

                $balance = new Balance();
                $balance->user_id = $user->getId();
                $balance->views = 50;
                $balance->likes = 50;
                $balance->save();

                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }



    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }



    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        }
        catch (InvalidArgumentException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
