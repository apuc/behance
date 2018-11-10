<?php

namespace backend\modules\orders;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * orders module definition class
 */
class Orders extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\orders\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

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
}
