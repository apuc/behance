<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('accounts', 'Parse Account');
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(['action' => ['/accounts/accounts/save-acc'], 'method' => 'post']); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('accounts', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
