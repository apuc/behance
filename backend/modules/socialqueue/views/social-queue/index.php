<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\socialqueue\models\SocialQueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('social-queue', 'Социальная очередь');
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
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user['email'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],

            [
                'attribute' => 'link_id',
                'filter' => false
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type['title'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'type_id',
                    'data' => $services,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'url',
                'contentOptions' => ['class' => 'social-queue-url'],
                'filter' => false
            ],
            [
                'attribute' => 'sum',
                'value' => function($data){
                    return strval(round($data['sum'] / \common\models\Settings::getSetting('balance_exponent'), 3));
                },
                'filter' => false
            ],
            [
                'attribute' => 'quantity',
                'filter' => false
            ],
            [
                'attribute' => 'balance',
                'filter' => false
            ],
            [
                'attribute' => 'dt_add',
                'filter' => false
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return \common\models\SocialQueue::getStatus($data->status);
                },
                'contentOptions' => function ($data) {
                    return $data->status == 0 ? ['style' => 'color: green'] : ['' => ''];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{turn-on} {turn-off} {refresh}',
                'header' => 'Действия',
                'buttons' => [

                    'turn-on' => function ($url, $data) {
                        if ($data->balance > 0 && $data->status == 2) {
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
                    'turn-off' => function ($url, $data) {
                        if ($data->balance > 0 && $data->status == 1) {
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

        ],
    ]); ?>
</div>
