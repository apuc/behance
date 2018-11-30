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
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </div>
    <div class="header__stars2 header__stars">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </div>
    <div class="header__stars3 header__stars">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </div>
    <div class="header__stars4 header__stars">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </div>
    <div class="header__stars5 header__stars">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </div>
    <div class="container auth-form-wrap">
        <div class="header">
            <img src="/images/checked.svg" alt="" class="pay-image">
            <p style="margin-bottom: 25px; font-size:25px; text-align: center;">Спасибо, оплата прошла успешно!</p>
            <p><?= Html::a('На главную','/',['class' => 'btn btn-pink', 'style'=>'margin: 0 auto; width:160px'])?></p>
        </div>
    </div>
</header>

