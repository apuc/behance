<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\SupportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Тех. Поддержка';
?>
<p>
    <?= Html::a('Написать в тех. поддержку', ['create'], ['class' => 'btn btn-success']) ?>
</p>


<div class="support-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'filter' => false
            ],
            [
                'attribute' => 'description',
                'filter' => false
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return \common\models\SupportQuestions::getStatus($data->status);
                },
            ],
            [
                'attribute' => 'date_add',
                'filter' => false
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}'
            ],*/
            [
                'format'=>'raw',
                'value'=>function($data){

                    return Html::a('Открыть',\yii\helpers\Url::toRoute('support/view/?id=' . $data->id),['class'=>'btn btn-primary']);
                }
            ],

        ],
    ]); ?>
</div>