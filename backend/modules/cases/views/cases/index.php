<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Cases;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cases\models\CasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cases', 'Cases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('cases', 'Create Cases'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


            [
              'attribute'=>'img',
                'format'=>'raw',
                'value'=>function($model){
                   return Html::img($model->img);
                }
            ],
            'name',
            'views',
            'likes',
            'price',
            'term',
            [
               'attribute'=>'status',
               'value'=>function($model){
                  return Cases::STATUS[$model->status];
               }
            ],
            ['class' => 'yii\grid\ActionColumn',
               'template'=>'{update} {delete}'
            ],

    ]]); ?>
</div>
