<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\queue\models\Queue */
/* @var $form yii\widgets\ActiveForm
 * @var $data array
 */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php echo (isset($works)) ? $form->field($model, 'work_id')->widget(Select2::classname(), [
		'data' => $works,
		'language' => 'ru',
		'options' => ['multiple' => false, 'placeholder' => 'Выберите работу'],
		'pluginOptions' => [
			'allowClear' => true
		],
	])->label('Работа') : "" ?>

    <?= $form->field($model, 'likes_work')->textInput() ?>

    <?= $form->field($model, 'views_work')->textInput() ?>

    <?= $form->field($model, 'account_views')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('queue', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
