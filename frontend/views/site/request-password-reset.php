<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Запрост востановления пароля';
$this->registerCssFile('/css/main.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$js = <<<JS
        swal({
                text: "На ваш email была отправленна ссылка для восстановления пароля!",
                buttons: {
                  confirm: {
                    text: 'OK',
                    value: true,
                    visible: true,
                    className: "btn btn-pink",
                    closeModal: true
                  }
                }
              });
JS;

if(Yii::$app->session->has('reset-password'))
{
    $this->registerJs($js);
}


?>
<header class="header-wrap header-wrap-auth">
    <div class="header__stars1 header__stars">
        <div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
    </div>

    <div class="container auth-form-wrap">
        <div class="header">
            <div class="header__phone header__phone_col">
                <h1 class="auth-title">Восстановление пароля</h1>
                <div class="header__phone-wrap header__phone-wrap-auth">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder'=>'email указанный при регистрации']) ?>


                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-pink', 'name' => 'login-button',
                            'style'=>'margin: 10px auto']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</header>