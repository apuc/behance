<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'views',
            'likes',
            'name',
//            'img:ntext',
	        [
		        'attribute'=>'img',
		        'label'=>'Картинка тарифа',
		        'format'=>'raw',
		        'value' => function ($model) {
			        return '<img src="'.$model->img.'">';},
	        ],
            'status',
            //'price',
            //'term',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
