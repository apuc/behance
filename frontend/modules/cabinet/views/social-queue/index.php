<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\SocialQueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $services array */

$this->title = 'Просмотр задач накрутки';
$this->params['breadcrumbs'][] = $this->title;
$js = <<< JS
let f = function () {
    $('.pjax-refresh').on('click', function(e) {
        e.preventDefault();
        let changeUrl = $(this).attr('refresh-url');
        let pjaxContainer = $(this).attr('pjax-container');              
        $.ajax({
            url: changeUrl,
            type: 'post',
            error: function(xhr, status, error) {
                alert('Ошибка запроса. Попробуйте позднее. Если ошибка продолжит возникать обратитесь в поддержку');
            }
        }).done(function(data) {
            if (data.success) {
                $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
            } else {
                alert(data.error);
            }
        });
    });
    $('.pjax-turn-on').on('click', function(e) {
        e.preventDefault();
        let changeUrl = $(this).attr('turn-on-url');
        let pjaxContainer = $(this).attr('pjax-container');              
        $.ajax({
            url: changeUrl,
            type: 'post',
            error: function(xhr, status, error) {
                alert('Ошибка запроса. Попробуйте позднее. Если ошибка продолжит возникать обратитесь в поддержку');
            }
        }).done(function(data) {
            if (data.success) {
                $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
            } else {
                alert(data.error);
            }
        });
    });
    $('.pjax-turn-off').on('click', function(e) {
        e.preventDefault();
        let changeUrl = $(this).attr('turn-off-url');
        let pjaxContainer = $(this).attr('pjax-container');              
        $.ajax({
            url: changeUrl,
            type: 'post',
            error: function(xhr, status, error) {
                alert('Ошибка запроса. Попробуйте позднее. Если ошибка продолжит возникать обратитесь в поддержку');
            }
        }).done(function(data) {
            if (data.success) {
                $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
            } else {
                alert(data.error);
            }
        });
    });
}
$(document).on('pjax:success', f);
$(document).ready(f)
JS;

$this->registerJs($js);
?>
<div class="social-works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'type_id',
            'value' => function ($data) use ($services) {
                return $services[$data->type_id];
            },
            'filter' => $services,
        ],
        'url',
        'balance',
        [
            'attribute' => 'status',
            'value' => function ($data) {
                return \common\models\SocialQueue::getStatus($data->status);
            },
            'contentOptions' => function ($data) {
                return $data->status == 0 ? ['style' => 'color: green'] : ['' => ''];
            },
            'filter' => [0 => "Выполнено", 1 => "Работает", 2 => "Остановлено"]
        ],
        'dt_add',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{turn-on} {turn-off} {refresh}',
            'header' => 'Действия',
            'buttons' => [
                'turn-on' => function ($url, $model) {
                    if ($model->balance > 0 && $model->status == 2) {
                        return Html::a('<span class="glyphicon glyphicon-play-circle fa-lg"></span>', false, [
                            'class' => 'pjax-turn-on',
                            'turn-on-url' => $url,
                            'pjax-container' => 'my_pjax',
                            'title' => Yii::t('social', 'turn-on')
                        ]);
                    } else {
                        return null;
                    }
                },
                'turn-off' => function ($url, $model) {
                    if ($model->balance > 0 && $model->status == 1) {
                        return Html::a('<span class="glyphicon glyphicon-off fa-lg"></span>', false, [
                            'class' => 'pjax-turn-off',
                            'turn-off-url' => $url,
                            'pjax-container' => 'my_pjax',
                            'title' => Yii::t('social', 'turn-off')
                        ]);
                    } else {
                        return null;
                    }
                },
                'refresh' => function ($url, $model) {
                    if ($model->balance > 0) {
                        return Html::a('<span class="glyphicon glyphicon-refresh fa-lg"></span>', false, [
                            'class' => 'pjax-refresh',
                            'refresh-url' => $url,
                            'pjax-container' => 'my_pjax',
                            'title' => Yii::t('social', 'refresh')
                        ]);
                    }
                }
            ],
        ],
    ];
    ?>

    <?php Pjax::begin(['id' => 'my_pjax']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>
    <?php Pjax::end(); ?>

</div>
