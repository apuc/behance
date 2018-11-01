<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\orders\models\Orders */
/* @var $form yii\widgets\ActiveForm
 * @var $accounts array
 * @var $cases array
 */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accounts_id')->dropDownList($accounts, ['prompt' => 'Выберите пользователя']) ?>

    <?= $form->field($model, 'cases_id')->dropDownList($cases, ['prompt' => 'Выберите тариф']) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Не выполнен', '1' => 'Выполнено']) ?>

    <?= $form->field($model, 'dt_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('orders', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
