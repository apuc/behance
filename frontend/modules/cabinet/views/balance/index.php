<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\SearchBalance */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('balance', 'Balances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('balance', 'Create Balance'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'accounts_id',
            'views',
            'likes',
	        [
		        'header'=> Yii::t('balance', 'History'),
		        'format' => 'raw',
		        'value' => function($model) {
			        return Html::a(
				        '<i class="fa fa-shopping-cart">'.Yii::t('balance', 'Look').'</i>',
				        Url::to(['history', 'slug' => $model->accounts_id]),
				        [
					        'data-id' => $model->id,
//					        'data-pjax'=>true,
					        'action'=>Url::to(['cart/add']),
					        'class'=>'btn btn-success gridview-add-to-cart',
				        ]
			        );
		        }
	        ],

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
