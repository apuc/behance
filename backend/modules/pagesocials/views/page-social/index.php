<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'social_title',
            [
                'attribute'=>'social_icon',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::img($data->social_icon,['width'=>'150','height'=>'150']);
                }
            ],
            'social_css',
            [
                'attribute' => 'enabled',
                'value' => function ($data) {
                    return $data->enabled == 1 ? 'Вкл' : 'Выкл';
                },
                'filter' => [0 => "Выкл", 1 => "Вкл"]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
