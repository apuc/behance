<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'История пополнений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
              'attribute'=>'likes',
              'filter'=>false,
            ],
            [
                'attribute'=>'views',
                'filter'=>false,
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
