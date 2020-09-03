<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\works\models\Works */

$this->title = 'Просмотр работы';
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="works-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Удалить работу', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'image',
              'format'=>'raw',
              'value'=>function($model){
                  return Html::img($model->image,['width'=>200,'height'=>200]);
              }
            ],
            [
              'attribute'=>'account_id',
              'value'=>function($model){
                    return $model->account['display_name'];
              }
            ],
            'behance_id',
            'url:url',
            'name',
            'start_likes',
            'start_views',
        ],
    ]) ?>

</div>
