<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\QueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Работы в очереди на лайк';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?= ""//Html::a('Create Queue', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label'=>'Картинка',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::img($data->work['image'],['width'=>150,'height'=>150]);
                }
            ],
            [
                'attribute'=>'work_id',
                'value'=>function($data){
                    return $data->work['name'];
                },
                'filter'=>false,
//                'filter'    => kartik\select2\Select2::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'work_id',
//                    'data' => $works,
//                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
//                    'pluginOptions' => [
//                        'allowClear' => true
//                    ],
//                ]),
            ],
            [
                'attribute'=>'likes_work',
                'filter'=>false
            ],
            [
                'attribute'=>'views_work',
                'filter'=>false
            ],
//            [
//                'attribute'=>'account_views',
//                'filter'=>false
//            ],
            [    'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>
</div>
