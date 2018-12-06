<?php
namespace frontend\controllers;


use common\models\Accounts;
use common\models\Balance;
use common\models\Callback;
use common\models\Cases;
use common\models\History;
use common\models\Reviews;
use common\models\Settings;
use common\models\User;

use common\services\AuthService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ResetPasswordRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use \common\models\ContactForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    private $authService;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','login','account-confirm','reset-password','request-password-reset'],
                'rules' => [
                    [
                        'actions' => ['signup','login','account-confirm','reset-password','request-password-reset'],
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
        ];
    }


    public function __construct($id,$module,array $config = [],AuthService $authService)
    {
        $this->authService = $authService;
        parent::__construct($id, $module, $config);
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


    /**
     * Displays aboutpage.
     *
     * @return mixed
     */
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


    /**
     * обработка контактно формы
     * @return bool
     */
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


    /**
     * обработка формы обратного звонка
     */
    public function actionCallback()
    {
        $phone = Yii::$app->request->post()['phone'];
        Callback::create($phone);
    }



    public function actionLogin()
    {
        $form = new LoginForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $this->authService->login($form->email);
            return $this->goHome();
        }

        $form->password = '';

        return $this->render('login', [
            'model' => $form,
        ]);
    }



    public function actionSignup()
    {
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $this->authService->signup($form,Yii::$app->request->get('ref'));

            Yii::$app->session->set('signup',true);
            return $this->refresh();
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }



    public function actionAccountConfirm($key,$ref = null)
    {
        $user = User::findByAuthKey($key);

        if(!$user)
        {
            return $this->redirect("/error");
        }

        $this->authService->emailConfirm($user,$ref);
        $this->authService->login($user->email);

        return $this->redirect('/cabinet');
    }



    public function actionRequestPasswordReset()
    {
        $form = new ResetPasswordRequestForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
           $this->authService->requestPasswordReset($form->email);
           Yii::$app->session->setFlash('reset-password',true);
        }

        return $this->render('request-password-reset', [
            'model' => $form,
        ]);
    }



    public function actionResetPassword($token)
    {
        if(!$user = User::findByPasswordResetToken($token))
        {
            return $this->redirect("/error");
        }

        $form = new ResetPasswordForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $this->authService->resetPassword($user,$form->password);
            $this->authService->login($user->email);
            return $this->redirect("/cabinet");
        }

        return $this->render('reset-password', [
            'model' => $form,
        ]);
    }
}
