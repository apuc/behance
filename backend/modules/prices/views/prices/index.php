<?php

use common\models\Settings;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\prices\models\PricesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('settings', 'Settings Price');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'key',
            [
              'attribute'=>'value',
                'contentOptions' => ['class' => 'grid-view-text-fix'],
                'filter'=>false,
                'value' =>
                    function ($data) {
                        if ($data['is_setting']) return $data['value'];
                        return $data['value'] / Settings::getSetting('balance_exponent')."$";
                    }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',

            ],
        ],
    ]); ?>
</div>
