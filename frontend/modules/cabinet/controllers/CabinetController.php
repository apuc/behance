<?php

namespace frontend\modules\cabinet\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CabinetController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index', 'view', 'create', 'update', 'save-works', 'save-acc', 'parse-account', 'parse-works'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
	
    public function actionIndex()
    {
        return $this->render('index');
    }
    
	public function actionLogout()
	{
		Yii::$app->user->logout();
		
		return $this->goHome();
	}

}
