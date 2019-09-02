<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\youtube\models\YoutubeQueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Youtube очередь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="youtube-queue-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="youtube-container">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//            'id',
                'url:url',
                'views',
                'duration',
                [
                    'label' => 'Лайки/Дизлайки/Просмотры',
                    'value' => function ($model) {
                        return $model->like . '/' . $model->dislike . '/' . $model->count_views;
                    }
                ],
                'name',
                [
                    'attribute' => 'img',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::img($model->img, ['width' => 100]);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
