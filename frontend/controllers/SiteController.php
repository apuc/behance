<?php
namespace frontend\controllers;


use common\models\Accounts;
use common\models\Balance;
use common\models\Callback;
use common\models\Cases;
use common\models\Debug;
use common\models\Declensions;
use common\models\History;
use common\models\Reviews;
use common\models\Settings;
use common\models\User;
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
	    $seo = Settings::findOne(['key'=>'seo_main_page']);
        $cases = Cases::find()->where(['!=', 'status', 0])->orderBy('price')->all();
        
        return $this->render('index', ['reviews' => $reviews, 'cases' => $cases,
            'seo'=>$seo]);
    }



    public function actionAbout()
    {
        $seo = Settings::findOne(['key'=>'seo_about_page']);
        return $this->render('about',['seo'=>$seo]);
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

        if ($form->load($post) && $form->validate())
        {
            $form->save(false);
            return true;
        }

        return false;
    }



    public function actionCallback()
    {
        $phone = Yii::$app->request->post()['phone'];
        Callback::create($phone);
    }



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



    public function actionSignup()
    {
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $user = User::create($form->email,$form->password);

            if($referer = Yii::$app->request->get('ref'))
            {
                $user->requestEmailConfirm($referer);
            }
            else
            {
                $user->requestEmailConfirm();
            }

            Yii::$app->session->set('signup',true);
            return $this->refresh();
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }



    public function actionAccountConfirm($key,$ref = null)
    {
        if($ref != null)
        {
            if($referer = User::findOne(['ref_hash'=>$ref]))
            {
                $referer_balance = Balance::findOne(['user_id'=>$referer->id]);
                $referer_balance->addBalance(100,0);

                History::create(
                         $referer->id,
                    History::TRANSFER_TO_BALANCE,
                    100,
                    0,
                    "Начислено 100 лайков за регестрацию по реферальной ссылке"
                );
            }
        }

        if($user = User::findOne(['auth_key'=>$key]))
        {
           $user->Activate();
           Yii::$app->getUser()->login($user);
           return $this->redirect('/cabinet');
        }
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
