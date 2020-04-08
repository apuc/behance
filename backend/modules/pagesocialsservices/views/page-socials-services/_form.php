<?php

use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocialsServices */
/* @var $form yii\widgets\ActiveForm */
/* @var $socials common\models\PageSocials[] */
/* @var $links array */
?>

<div class="page-socials-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_social')->widget(Select2::className(), [
        'model' => $model,
        'data' => $socials,
        'options' => ['placeholder' => 'Выберите соц. сеть'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ]); ?>

    <?= $form->field($model, 'service_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_description')->widget(CKEditor::className(),
        ['editorOptions' => ElFinder::ckeditorOptions('elfinder', ['preset' => 'full', 'inline' => false,])]) ?>
    <p>* - формат указание суммы за 1000 лайков <i>(priceRUB - указать в рублях) (priceUSD - указать в долларах США)</i></p>
    <?= $form->field($model, 'service_seo_title')->textInput()->label('SEO название') ?>
    <?= $form->field($model, 'service_seo_descr')->textInput()->label('SEO описание') ?>
    <?= $form->field($model, 'service_seo_keywords')->textInput()->label('SEO ключевые слова') ?>

    <?= $form->field($model, 'service_order_link')->dropDownList($links) ?>
    <p>* - формат ссылки &quot;<i>cabinet/social-queue/create?social=&lt;код соц. сети&gt;&amp;service=&lt;код услуги&gt;</i>&quot;, коды <a href="<?= Url::to(['admin/vipip-socials']) ?>">тут</a></p>
    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
