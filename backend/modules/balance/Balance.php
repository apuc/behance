<?php

namespace backend\modules\balance;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * balance module definition class
 */
class Balance extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */



    public $controllerNamespace = 'backend\modules\balance\controllers';

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
                        'allow' => true,
                        'roles' => ['admin','manager'],
                    ],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
