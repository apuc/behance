<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\pagesocials\models\PageSocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Соц. сети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-socials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать соц. сеть', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'soc_code',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->status == 1 ? 'Вкл' : 'Выкл';
                },
                'filter' => [0 => "Выкл", 1 => "Вкл"]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
