<?php

use common\models\PageSocialsServices;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vipipsocials\models\SocialServiceCustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги соц. сетей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vipip-socials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'social_name',
                'label' => "Соц. сеть",
                'value' => function ($data) {
                    /** @var $data \common\models\SocialService */
                    return $data->social->name;
                }
            ],
            [
                'attribute' => 'id_soc',
                'label' => "Код соц. сети",
            ],
            [
                'attribute' => 'type_id',
                'label' => "Код услуги",
            ],
            'title',
            'system_title',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}']
        ],
    ]); ?>

</div>
