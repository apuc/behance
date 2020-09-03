<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\balancecash\models\BalanceCash */

$this->title = 'Create Balance Cash';
$this->params['breadcrumbs'][] = ['label' => 'Balance Cashes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-cash-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
