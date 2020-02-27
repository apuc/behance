<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocials */

$this->title = $model->social_title;
$this->params['breadcrumbs'][] = ['label' => 'Page Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-socials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'social_title',
            'social_icon',
            'social_css',
            [
                'attribute' => 'enabled',
                'value' => function ($data) {
                    return $data->enabled == 1 ? 'Вкл' : 'Выкл';
                }
            ],
        ],
    ]) ?>

</div>
