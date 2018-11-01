<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cases\models\Cases */

$this->title = Yii::t('cases', 'Update Cases: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cases', 'Cases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cases', 'Update');
?>
<div class="cases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
