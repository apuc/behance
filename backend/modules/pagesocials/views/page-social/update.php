<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocials */

$this->title = 'Обновить соц.сеть: ' . $model->social_title;
$this->params['breadcrumbs'][] = ['label' => 'Соц. сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->social_title, 'url' => ['view', 'id' => $model->social_title]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="page-socials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
