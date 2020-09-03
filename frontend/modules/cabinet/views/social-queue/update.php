<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SocialQueue */

$this->title = 'Изменить параметры задачи: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Social Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
// TODO: write _form_update
?>
<div class="social-works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
