<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\pagesocialsservices\models\PageSocialsServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-socials-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_social') ?>

    <?= $form->field($model, 'service_title') ?>

    <?= $form->field($model, 'service_description') ?>

    <?= $form->field($model, 'service_seo') ?>

    <?php // echo $form->field($model, 'service_page_link') ?>

    <?php // echo $form->field($model, 'service_order_link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
