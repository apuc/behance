<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Settings */
/* @var $form yii\widgets\ActiveForm */
$meta = json_decode($model->value);
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(isset($create)): ?>
    <div class="form-group">
        <label>Название</label>
        <?= Html::textInput('page_name','',['class'=>'form-control']); ?>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label>Заголовок</label>
        <?= Html::textInput('title',($meta) ? $meta->title : '' ,['class'=>'form-control']); ?>
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <?= Html::textarea('descr',($meta) ? $meta->descr : '',['class'=>'form-control','rows'=>6]) ?>
    </div>

    <div class="form-group">
        <label>Meta keywords</label>
        <?= Html::textarea('keywords',($meta) ? $meta->keywords : '',['class'=>'form-control','rows'=>6]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('settings', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
