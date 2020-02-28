<?php

use common\models\PageSocialsServices;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\pagesocialsservices\models\PageSocialsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $socials PageSocialsServices[] */

$this->title = 'Услуги соц. сетей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-socials-services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать услугу соц. сети', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_social',
                'value' => function ($data) use ($socials) {
                    return $socials[$data->id_social];
                },
                'filter' => $socials,
            ],
            'service_title',
            [
                'attribute' => 'enabled',
                'value' => function ($data) {
                    return $data->enabled == 1 ? 'Вкл' : 'Выкл';
                },
                'filter' => [0 => "Выкл", 1 => "Вкл"]
            ],
            //'service_page_link',
            //'service_order_link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
