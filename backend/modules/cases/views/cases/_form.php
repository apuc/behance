<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cases\models\Cases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'behance_id')->textInput() ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'likes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cases', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
