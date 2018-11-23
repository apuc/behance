<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\orders\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки из формы контактов';

?>
<div class="contact-form-index">

    <h1><?= Html::encode($this->title) ?></h1>


<!--    <p>-->
<!--        --><?= ""///Html::a('Create Contact Form', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//          'id',
            'name',
            'email',
            [
                'attribute'=>'link',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::a('Ссылка',$data->link);
                }
            ],
            'message:ntext',
            'dt_add',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($data){
                     if($data->status == 0)
                       return Html::a('Прочитанно','/admin/orders/contact/mark-as-read?id='.$data->id,['class'=>'btn btn-success']);

                     return "";
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],

        ],
    ]); ?>
</div>
