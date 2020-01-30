<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HistoryCash */

$this->title = 'Create Cash History';
$this->params['breadcrumbs'][] = ['label' => 'Cash Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
