<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\history\models\History */

$this->title = Yii::t('history', 'Create History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('history', 'Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
