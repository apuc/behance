<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\controllers\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Настройки SEO";

?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                    'label'=>'Страница',
               'attribute'=>'key',
                'value'=> function($model){
                    return str_replace('seo_','',$model->key);
                }
            ],

            [
                'label'=>'Заголовок',
                'attribute'=>'key',
                'value'=> function($model){
                    return json_decode($model->value)->title;
                }
            ],


            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]); ?>
</div>
