<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reviews\models\Reviews */

$this->title = Yii::t('reviews', 'Update Reviews: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('reviews', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('reviews', 'Update');
?>
<div class="reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
