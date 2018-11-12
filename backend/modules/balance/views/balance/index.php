<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\balance\controllers\BalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Баланс пользователей";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?="" //Html::a(Yii::t('balance', 'Начислить лайки и просмотры'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                    'attribute'=>'user_id',
                   'value'=>function($data){
                       return $data->user['email'];
                   },
                   'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute'=>'views',
                'filter'=>false,

            ],
            [
                'attribute'=>'likes',
                'filter'=>false,
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>
</div>
