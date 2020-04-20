<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\historycash\models\HistoryCash */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('history-cash', 'HistoriesCashes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="historycash-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'description:ntext',
            'user_id',
            'dt_add',
            'amount',
        ],
    ]) ?>

</div>

