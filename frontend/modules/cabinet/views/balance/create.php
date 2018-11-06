<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\cabinet\models\Balance */

$this->title = Yii::t('balance', 'Create Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('balance', 'Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
