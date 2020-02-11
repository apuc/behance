<?php

use common\models\Settings;
use frontend\modules\cabinet\models\SocialQueueForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model SocialQueueForm */
/* @var $socials array */
/* @var $form yii\widgets\ActiveForm */
/* @var $friends_options array */
/* @var $friends_prices array */
/* @var $errors string */
$exponent = intval(Settings::getSetting('balance_exponent'));
// look into social-query.js for usage of friend_prices and price_coeff
?>
<script>
   var friend_prices = [];
   <?php foreach ($friends_prices as $friends_price) { ?>
       friend_prices.push(<?= $friends_price ?>);
   <?php } ?>
   var exponent = <?= $exponent ?>;
</script>
<!-- socialqueue-*var name* -->
<?php if ($errors != null) { ?>
    <div class="alert alert-danger display-error" style="display: block"><?= $errors ?></div>
<?php }
// TODO: output errors like with 0 balance ?>
<div class="social-queue-form">

    <?php $form = ActiveForm::begin([
    ]); ?>

    <div class="form-group" id ="div_social">
    <?= $form->field($model, 'social')->widget(Select2::className(), [
        'model' => $model,
        'data' => $socials,
        'options' => ['placeholder' => 'Выберите соц. сеть'],
        'pluginOptions' => [
            'allowClear' => false
        ],
        'pluginEvents' => [
            "change.select2" => "function() {
                ajaxChangeData($); 
             }",
        ]
    ]); ?>
    </div>

    <div class="form-group" id ="div_type_id">
    <?= $form->field($model, 'type_id')->widget(Select2::className(), [
            'model' => $model,
            'options' => ['placeholder' => 'Выберите услугу'],
            'pluginOptions' => [
                'allowClear' => false
            ],
            'pluginEvents' => [
                "change.select2" => "function() {
                    enableDisableFields($); 
                 }",
            ]
        ]); ?>
    </div>

    <div class="form-group" id ="div_balance">
        <?= $form->field($model, 'balance')->textInput(['type' => 'number']) ?>
    </div>

    <div class="form-group" id ="div_link">
        <?= $form->field($model, 'link')->textInput(['placeholder' => 'Введите ссылку на нужный ресурс']) ?>
    </div>

    <div class="form-group" id ="div_msg">
        <?= $form->field($model, 'msg')->textarea(['placeholder' => 'Введите текст поста, макс. 140 символов']) ?>
    </div>

    <div class="form-group" id ="div_answer">
        <h3 class='font-italic' id="poll_text"></h3>
        <?= $form->field($model, 'answer_id')->widget(Select2::className(), [
            'model' => $model,
            'options' => ['placeholder' => 'Выберите вариант ответа'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]); ?>
    </div>

    <div class="form-group" id ="div_friends">
        <?= $form->field($model, 'friends_id')->widget(Select2::className(), [
            'model' => $model,
            'data' => $friends_options,
            'options' => ['placeholder' => 'Выберите количество друзей'],
            'pluginOptions' => [
                'allowClear' => false
            ],
            'pluginEvents' => [
                "change.select2" => "function() {
                    calculatePrice($); 
                 }",
            ]
        ]); ?>
    </div>

    <div class="row" id="div_age">
        <div class="col-md-6" id="div_age_min">
            <?= $form->field($model, 'age_min')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6" id="div_age_max">
            <?= $form->field($model, 'age_max')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="form-group" id ="div_gender">
        <?= $form->field($model, 'gender')->widget(Select2::className(), [
            'model' => $model,
            'data' => [
                '-' => 'Не важно',
                'm' => 'Мужской',
                'f' => 'Женский'
            ],
            'options' => ['placeholder' => 'Выберите пол посещающих'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]); ?>
    </div>
    <div class="form-group" id="div_price">
        <h3 class='font-italic' id="price_text"></h3>
        <?= $form->field($model, 'price')->hiddenInput()->label(false); ?>
    </div>

    <!-- TODO: mb add streamtimer, collapsible geography and calendar -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id' => 'success_button', 'disabled' => true]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
