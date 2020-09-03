<?php

use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use xtarantulz\preview\PreviewAsset;
PreviewAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\modules\cases\models\Cases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'likes')->textInput() ?>
	
	<?= $form->field($model, 'views')->textInput() ?>
	
	<?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
	
	<?=$form->field($model, 'img')->widget(InputFile::className(), [
		'language'      => 'ru',
		'controller'    => 'elfinder',
		'filter'        => 'image',
		'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
		'options'       => ['class' => 'form-control img'],
		'buttonOptions' => ['class' => 'btn btn-default'],
		'multiple'      => false       // возможность выбора нескольких файлов
	])->label('Фото');?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Cases::STATUS) ?>

    

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cases', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
