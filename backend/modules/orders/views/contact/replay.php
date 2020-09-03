<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\orders\models\ContactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form-search">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
    ]); ?>


    <div class="form-group">
        <label for="">Сообщение</label>
        <?= Html::hiddenInput('email',$email)?>
        <?= Html::textarea('message','',['class'=>'form-control','rows'=>8,'required'=>''])?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
