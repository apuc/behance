<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\works\controllers\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('works', 'Works');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'img',
                'label'=>'Картинка',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::img($data->image,['width'=>'200','height'=>'150']);
                }
            ],
            [
                'attribute'=>'account_id',
                'value'=>function($data){
                    return $data->account['display_name'];
                },
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'account_id',
                    'data' => $account_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            //'behance_id',
            [
                'attribute'=>'name',
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'name',
                    'data' => $works_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute'=>'url',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                    return Html::a('Ссылка',$data->url,['target'=>'_blank']);
                }
            ],


            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete} {view}'
            ],
        ],
    ]); ?>
</div>
