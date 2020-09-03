<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\queue\models\Queue */

$this->title = Yii::t('queue', 'Create Queue');
$this->params['breadcrumbs'][] = ['label' => Yii::t('queue', 'Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'works' => $works,
    ]) ?>

</div>
