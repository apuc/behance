<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\SearchBalance */
/* @var $dataProvider yii\data\ActiveDataProvider
 * @var $account object
 */
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
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'accounts_id',
	        [
		        'attribute'=>'accounts_id',
		        'label'=>'Аккаунт',
		        'format'=>'raw',
		       'value' => function ($model) use ($account) {
                return  $account->display_name;},
	        ],
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
					        'action'=>Url::to(['cart/add']),
					        'class'=>'btn btn-success gridview-add-to-cart',
				        ]
			        );
		        }
	        ],
	      
//            ['class' => 'yii\grid\ActionColumn',   'template' => '{view}', ],
	       
        ],
    ]); ?>
</div>

<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                fsfdsfsdf
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>