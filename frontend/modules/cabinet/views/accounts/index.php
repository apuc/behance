<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аккаунты';
?>


    <h1>Аккаунты</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить аккаунт', ['create'], ['class' => 'btn btn-pink']) ?>
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
           [
                   'attribute'=>'display_name',
               'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
               'attribute' => 'display_name',
                    'data' => $display_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
           ],
            [
                'attribute'=>'username',
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'username',
                    'data' => $usernames,
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
                    return Html::a('ссылка',$data->url,['target'=>'_blank']);
                }
            ],

            //'title',
            //'behance_id',

            [
              'format'=>'raw',
              'value'=>function($data){
                return Html::a('Обновить работы','/cabinet/accounts/parse?url='.$data->url,['class'=>'btn btn-pink']);
              }
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]); ?>

