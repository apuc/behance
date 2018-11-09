<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

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
        $user->email = 'super@admin.com';
        $user->username = 'superadmin';
        $user->setPassword('321756');
        $user->generateAuthKey();
        $user->save();


        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());
    }
}