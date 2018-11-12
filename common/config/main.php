<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
//	        'class'=>'backend\components\LangUrlManager',
//	        'languages' => ['en', 'ru'],
	        'rules' => [
		        '' => 'site/index',
		        ['pattern' => 'robots', 'route' => 'robotsTxt/web/index', 'suffix' => '.txt'],
		        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
//		        '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//		        'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
	        ],
        ],
        'authManager'  => [
	        'class'        => 'yii\rbac\DbManager',
//	        'class' => 'dektrium\rbac\components\DbManager',
        ],
        'i18n' => [
	        'translations' => [
		        '*' => [
			        'class' => 'yii\i18n\PhpMessageSource',
			        'basePath' => '@common/messages',
			        'sourceLanguage' => 'ru',
			        'fileMap' => [
				        'main' => 'main.php',
			        ],
		        ],
	        ],
        ],
    ],
    'controllerMap' => [
	    'elfinder' => [
		    'class' => 'mihaildev\elfinder\PathController',
		    'access' => ['@'],
		    'root' => [
			    'baseUrl' => '',
			    'basePath' => '@frontend/web',
			    'path' => 'uploads/global',
			    'name' => 'Global'
		    ],
		    'connectOptions' => [
			    'bind' => array(
				    'upload.presave' => array(
					    'Plugin.CompressingImage.onUpLoadPreSave'
				    )
			    ),
			    'plugin' => [
				    'CompressingImage' => [
					    'quality' => 85
				    ]
			
			    ],
		    ],
	    ]
    ],
];
