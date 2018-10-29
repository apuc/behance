<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\queue\models\Queue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_id')->textInput() ?>

    <?= $form->field($model, 'likes_count')->textInput() ?>

    <?= $form->field($model, 'views_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('queue', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
