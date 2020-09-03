<?php

namespace frontend\modules\cabinet;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * cabinet module definition class
 */
class Cabinet extends \yii\base\Module
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\cabinet\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
