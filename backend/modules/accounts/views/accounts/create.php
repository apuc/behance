<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Accounts */

$this->title = Yii::t('accounts', 'Create Accounts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('accounts', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
