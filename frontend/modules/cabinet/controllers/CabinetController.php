<?php

namespace frontend\modules\cabinet\controllers;

use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CabinetController extends \yii\web\Controller
{

	
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionReferal()
    {
        return $this->render('referal');
    }



	public function actionLogout()
	{
		Yii::$app->user->logout();
		
		return $this->goHome();
	}

}
