<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-socials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'social_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_icon')->textInput() ?>

    <?= $form->field($model, 'social_css')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
