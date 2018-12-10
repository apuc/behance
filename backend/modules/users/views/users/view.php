<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->email;

\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны что хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            [
                'label'=>'Роль',
                'value'=>function($m){
                    return array_keys(Yii::$app->authManager->getRolesByUser($m->id))[0];
                }
            ],
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
                'attribute'=>'created_at',
                'value'=>function($m){
                    return date("d-m-Y",$m->updated_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'value'=>function($m){
                    return date("d-m-Y",$m->updated_at);
                }
            ],
            'auth_key',
            'password_hash',
            'password_reset_token',
            'ref_hash',
        ],
    ]) ?>

</div>
