<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\HistoryCashSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'История пополнений денег';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-cash-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
              'attribute'=>'amount',
              'filter'=>false,
              'value' => function ($model) {
                    return $model->amount / \common\models\Settings::getSetting('balance_exponent');
              }
            ],
            [
               'attribute'=>'type',
                'filter'    => false
            ],
            [
                'attribute'=>'description',
                'filter'=>false,
            ],
            'dt_add',
        ],
    ]); ?>
</div>
