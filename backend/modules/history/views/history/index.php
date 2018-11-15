<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\history\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('history', 'Histories');
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
               'attribute'=>'likes',
               'filter'=>false
            ],
            [
                'attribute'=>'views',
                'filter'=>false
            ],
            [
               'attribute'=>'type',
                'filter'    => false
            ],
            [
                'attribute'=>'description',
                'filter'=>false
            ],
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
            'dt_add',
            //'likes',
            //'views',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{delete}'
            ],
        ],
    ]); ?>
</div>
