<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Звонки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callback-index">

    <h1><?= Html::encode($this->title) ?></h1>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//          'id',
            'phone_number',
            'dt_add',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->status == \common\models\Callback::UNCHECKED)
                        return "Не просмотренно";

                    return "Просмотренно";
                }
            ],
            [


                'format'=>'raw',
                'value'=>function($data){
                    if($data->status == \common\models\Callback::UNCHECKED)
                        return Html::a('Просмотренно','/admin/orders/callback/mark-as-checked?id='.$data->id,['class'=>'btn btn-success']);

                    return "";
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],

        ],
    ]); ?>
</div>
