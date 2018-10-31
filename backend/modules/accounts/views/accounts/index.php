<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\accounts\controllers\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('accounts', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('accounts', 'Create Accounts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<p>
		<?= Html::a(Yii::t('accounts', 'Parse Account'), ['parse-account'], ['class' => 'btn btn-success']) ?>
	</p>

	<p>
		<?= Html::a(Yii::t('accounts', 'Parse Works'), ['parse-works'], ['class' => 'btn btn-success']) ?>
	</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'title',
            'behance_id',
            'display_name',
            //'username',
            //'image:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
