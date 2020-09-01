<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model0 common\models\SupportAnswers*/
/* @var $form yii\widgets\ActiveForm */
?>
<div class="support-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model0, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Написать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
