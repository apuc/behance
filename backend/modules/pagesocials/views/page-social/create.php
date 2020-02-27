<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocials */

$this->title = 'Create Page Socials';
$this->params['breadcrumbs'][] = ['label' => 'Page Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-socials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
