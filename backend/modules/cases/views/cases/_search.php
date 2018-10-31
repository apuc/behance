<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cases\controllers\CasesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'behance_id') ?>

    <?= $form->field($model, 'views') ?>

    <?= $form->field($model, 'likes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cases', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cases', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
