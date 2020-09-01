<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SupportQuestions*/
///* @var $socials common\models\Social*/
/* @var $form yii\widgets\ActiveForm */
?>
<div class="support-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Написать', ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('support', 'Вернуться назад'), ['index'], ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
