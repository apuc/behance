<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', [
                'class' => 'btn btn-pink',
                'onclick' => "gtag('event', 'account', { 'event_category': 'form', 'event_action': 'account', }); yaCounter51223025.reachGoal('account'); return true;"
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
