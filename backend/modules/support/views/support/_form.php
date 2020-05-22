<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model0 common\models\SupportAnswers*/
/* @var $form yii\widgets\ActiveForm */
?>
<div class="support-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model0, 'text')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'min',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
