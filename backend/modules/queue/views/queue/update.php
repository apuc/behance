<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\queue\models\Queue */

$this->title = Yii::t('queue', 'Update Queue: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('queue', 'Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('queue', 'Update');
?>
<div class="queue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
