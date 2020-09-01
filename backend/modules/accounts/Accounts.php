<?php

namespace backend\modules\accounts;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * accounts module definition class
 */
class Accounts extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\accounts\controllers';

    /**
     * {@inheritdoc}
     */

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

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
