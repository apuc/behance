<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\balance\models\Balance */
/* @var $form yii\widgets\ActiveForm
 * @var $accounts array
 */
?>

<div class="balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'likes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('balance', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
