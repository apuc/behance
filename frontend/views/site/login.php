<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
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

            <div class="header__phone">
                <div class="header__phone-wrap header__phone-wrap-auth">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

<!--                    --><?php echo "" //$form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="margin:1em 0; display: flex; justify-content: center">
                         <?= Html::a('Регистрация', ['site/signup'],['style'=>'color:white;']) ?>.
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button',
                            'style'=>'margin: 0 auto']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</header>

