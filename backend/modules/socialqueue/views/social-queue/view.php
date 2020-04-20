<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\socialqueue\models\SocialQueue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('social-queue', 'SocialQueue'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="socialqueue-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'type_id',
            'link_id',
            'url',
            'balance',
            'dt_add',
            'status',
        ],
    ]) ?>

</div>