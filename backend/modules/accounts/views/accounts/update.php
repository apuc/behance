<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Accounts */

$this->title = Yii::t('accounts', 'Update Accounts: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('accounts', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('accounts', 'Update');
?>
<div class="accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
