<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
            'users' => [
                'class' => 'backend\modules\users\User',
            ],
        'accounts' => [
            'class' => 'backend\modules\accounts\Accounts',
        ],
        'works' => [
            'class' => 'backend\modules\works\Works',
        ],
        'queue' => [
            'class' => 'backend\modules\queue\Queue',
        ],
        'settings' => [
            'class' => 'backend\modules\settings\Settings',
        ],
        'balance' => [
	        'class' => 'backend\modules\balance\Balance',
        ],
        'cases' => [
	        'class' => 'backend\modules\cases\Cases',
        ],
        'orders' => [
	        'class' => 'backend\modules\orders\Orders',
        ],
        'reviews' => [
	        'class' => 'backend\modules\reviews\Reviews',
        ],
        'history' => [
	        'class' => 'backend\modules\history\History',
        ],
        'youtube' => [
            'class' => 'backend\modules\youtube\Youtube',
        ]

    ],
    'components' =>  [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ssl://mail.adm.tools',
                'username' => 'info@betop.space',
                'password' => '123edsaqw',
                'port' => '25',
            ],

            'useFileTransport' => false, // будем отправлять реальные сообщения, а не в файл
        ],
        'request' => [
            'baseUrl' => '/secure',
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced',
            'cookieParams' =>[
                'httpOnly' => true,
                //'domain' => $params['cookieDomain'],
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

//'view' => [
//    'theme' => [
//        'pathMap' => [
//            '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//        ],
//    ],
//],
	    /*ЧПУ*/
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
//	        'class'=>'backend\components\LangUrlManager',
//	        'languages' => ['en', 'ru'],
	        'rules' => [
		        '/' => 'admin/index',
		        '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
		        'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
	        ],
        ],

    ],
    'params' => $params,

];
