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
    $('.pjax-change-status').on('click', function(e) {
             e.preventDefault();
             var changeUrl = $(this).attr('change-status-url');
             var pjaxContainer = $(this).attr('pjax-container');
             var result = confirm('Изменить статус?');                                
             if(result) {
                 $.ajax({
                     url: changeUrl,
                     type: 'post',
                     error: function(xhr, status, error) {
                         alert('Ошибка запроса. Попробуйте позднее. Если ошибка продолжит возникать обратитесь в поддержку');
                     }
                 }).done(function(data) {
                     $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
                 });
             }
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

    <?php Pjax::begin(['id' => 'my_pjax']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return \common\models\SocialService::findOne(['type_id' => $data->type_id])->title;
                },
                'filter' => $services,
            ],
            'url',
            'balance',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return $data->status == 1 ? 'Работает' : 'Завершено';
                },
                'filter' => [ 0=>"Завершено", 1=>"Работает"]
            ],
            'dt_add',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{change-status}',
                'header' => 'Изменить статус',
                'buttons' => [
                    'change-status' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', false, [
                            'class' => 'pjax-change-status',
                            'change-status-url' => $url,
                            'pjax-container' => 'my_pjax',
                            'title' => Yii::t('social', 'change')
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
