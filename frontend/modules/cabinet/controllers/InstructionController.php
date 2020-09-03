<?php


namespace frontend\modules\cabinet\controllers;

use yii\base\Controller;

class InstructionController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}