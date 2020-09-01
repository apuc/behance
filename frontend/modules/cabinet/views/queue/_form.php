<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Queue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_id')->textInput() ?>

    <?= $form->field($model, 'likes_work')->textInput() ?>

    <?= $form->field($model, 'views_work')->textInput() ?>

    <?= $form->field($model, 'account_views')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
