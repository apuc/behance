<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'email:email',
            [

                'attribute'=>'status',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($m){
                     if($m->status == \common\models\User::STATUS_ACTIVATED)
                        return "<font color='green'>Активирован</font>";
                    else
                     return "<font color='red'>Не активирован</font>";
                }
            ],
            [
                    'filter'=>false,
              'attribute'=>'created_at',
              'value'=>function($m){
                 return date("d-m-Y",$m->created_at);
              }
            ],
            [
                'filter'=>false,
                'attribute'=>'updated_at',
                'value'=>function($m){
                    return date("d-m-Y",$m->updated_at);
                }
            ],
            [
              'label'=>'Роль',
              'value'=>function($m){
                   $roles = array_keys(Yii::$app->authManager->getRolesByUser($m->id));
                  if($roles)
                      return $roles[0];
              }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
