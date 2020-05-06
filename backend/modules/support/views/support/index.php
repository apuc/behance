<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\support\models\SupportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('support', 'Тех. Поддержка');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="support-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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

                    return Html::a('Открыть',\yii\helpers\Url::toRoute('/support/support/view/?id=' . $data->id),['class'=>'btn btn-primary']);
                }
            ],

        ],
    ]); ?>
</div>