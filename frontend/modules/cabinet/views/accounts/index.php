<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1>Аккаунты</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить аккаунт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                    'attribute'=>'image',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                   return Html::img($data->image,['width'=>100,'height'=>'100']);
                }
            ],
            'display_name',
            'username',
            [
                'attribute'=>'url',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                    return Html::a($data->url,$data->url,['target'=>'_blank']);
                }
            ],

            //'title',
            //'behance_id',

            [
              'format'=>'raw',
              'value'=>function($data){
                return Html::a('Обновить работы','/cabinet/accounts/parse?id='.$data->id.'&url='.$data->url,['class'=>'btn btn-primary']);
              }
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]); ?>

