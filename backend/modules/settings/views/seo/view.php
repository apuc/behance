<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Settings */

$this->title = $model->key;

$meta = json_decode($model->value);

\yii\web\YiiAsset::register($this);
?>
<div class="settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('settings', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('settings', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('settings', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
               'label'=>'Заголовок',
               'value'=>$meta->title,
            ],
            [
                'label'=>'Meta description',
                'value'=>$meta->descr,
            ],
            [
                'label'=>'Meta keywords',
                'value'=>$meta->keywords,
            ],

        ],
    ]) ?>

</div>
