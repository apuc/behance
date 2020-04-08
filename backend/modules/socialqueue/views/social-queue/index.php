<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\socialqueue\models\SocialQueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('social-queue', 'Социальная очередь');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user['email'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],

            [
                'attribute' => 'link_id',
                'filter' => false
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type['title'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'type_id',
                    'data' => $services,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'url',
                'filter' => false
            ],
            [
                'attribute' => 'balance',
                'filter' => false
            ],
            [
                'attribute' => 'dt_add',
                'filter' => false
            ],
            [
                'attribute' => 'status',
                'filter' => false
            ],

        ],
    ]); ?>
</div>
