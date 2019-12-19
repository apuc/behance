<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->registerCssFile('/css/main.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
?>
<header class="header-wrap header-wrap-auth">
    <div class="header__stars1 header__stars">
        <div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
    </div>
    <div class="container auth-form-wrap">
        <div class="header">
            <?php if (!Yii::$app->session->has('signup')): ?>
                <div class="header__phone header__phone_col">
                    <h1 class="auth-title">Регистрация</h1>
                    <div class="header__phone-wrap header__phone-wrap-auth">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Зарегистрироваться', [
                                'class' => 'btn btn-pink',
                                'name' => 'signup-button',
                                'style' => 'margin: 0 auto',
                                'onsubmit' => "ga ('send', 'event', 'form', 'register'); yaCounter53666866.reachGoal('register'); return true;"
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php else: ?>
                <?php Yii::$app->session->remove('signup') ?>
                <p style="margin-bottom: 25px; font-size:25px; text-align: center;">Ваш аккаунт успешно создан! Для
                    завершения регистрации подтвердите email!</p>
                <p><?= Html::a('На главную', '/', ['class' => 'btn btn-pink', 'style' => 'margin: 0 auto; width:160px']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</header>

