<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;
use yii\helpers\Console;

class RbacController extends Controller
{
	public function actionInit()
	{
		$auth = Yii::$app->authManager;
		
		
		$admin = $auth->createRole('admin');
		$auth->add($admin);
		
		$user = $auth->createRole('user');
		$auth->add($user);
		
		$manager = $auth->createRole('manager');
		$auth->add($manager);
		
		$user = new User();
		$user->email = 'apuc06@mail.ru';
		$user->username = 'superadmin';
		$user->setPassword('ZEVyaDUeKj');
		$user->generateAuthKey();
		$user->save();
		
		
		$authorRole = $auth->getRole('admin');
		$auth->assign($authorRole, $user->getId());
		
		$this->stdout("Complete!\n",Console::FG_GREEN);
	}
}