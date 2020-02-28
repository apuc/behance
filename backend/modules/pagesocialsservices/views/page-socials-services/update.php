<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocialsServices */
/* @var $socials common\models\PageSocials[] */

$this->title = 'Обновить услугу: ' . $model->service_title;
$this->params['breadcrumbs'][] = ['label' => 'Page Socials Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->service_title, 'url' => ['view', 'id' => $model->service_title]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-socials-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'socials' => $socials
    ]) ?>

</div>
