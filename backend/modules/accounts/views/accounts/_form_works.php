<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('accounts', 'Parse Works');
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(['method' => 'post']); ?>


    <div class="form-group">
        <label for="">Выберите аккаунт</label>
        <?= Html::dropDownList('account','',$accounts,['class'=>'form-control']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('accounts', 'Parse'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
