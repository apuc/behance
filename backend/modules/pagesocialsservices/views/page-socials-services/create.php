<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocialsServices */
/* @var $socials common\models\PageSocials[] */

$this->title = 'Create Page Socials Services';
$this->params['breadcrumbs'][] = ['label' => 'Page Socials Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-socials-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'socials' => $socials
    ]) ?>

</div>