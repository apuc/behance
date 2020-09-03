<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use xtarantulz\preview\PreviewAsset;
PreviewAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\modules\reviews\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?=$form->field($model, 'photo')->widget(InputFile::className(), [
		'language'      => 'ru',
		'controller'    => 'elfinder',
		'filter'        => 'image',
		'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
		'options'       => ['class' => 'form-control img'],
		'buttonOptions' => ['class' => 'btn btn-default'],
		'multiple'      => false       // возможность выбора нескольких файлов
	])->label('Фото');?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'nick_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'dt_add')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('reviews', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
