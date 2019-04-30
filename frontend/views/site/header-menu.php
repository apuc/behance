<?php

use yii\helpers\Url;

$enterIcon = "/images/icons/ico-enter.png";
$cabinetIcon = "/images/icons/ico-user.png";


if (Yii::$app->controller->action->id == 'about') {
    $enterIcon = "/images/icons/ico-enter-blue.png";
    $cabinetIcon = "/images/icons/ico-user-blue.png";

}


?>
<div class="header__menu">
  <div class="header__left">
    <a class="header__menu-btn" href="mailto:info@avtouzor.ru">
      <span class="header__menu-btn-round">@</span>
      <span class="header__menu-btn-text">
          <span class="fz12 fw-extra-bold">info@betop.space</span>
      </span>
    </a>

    <div class="header__menu-btn">
      <div class="header__menu-btn-round">
          <i class="fa fa-phone"></i>
      </div>

      <div class="header__menu-btn-text">
        <a class="header__btn fz12 fw-extra-bold" href="tel:+8 812 319-36-02">+7 928 770 19 79</a>
        <button class="header__btn fz10 fw-medium js-backCall" type="button">Заказать обратный звонок</button>
      </div>
    </div>
  </div>
  <div class="header__right">
    <nav class="header__nav">
    </nav>
      <?php if (Yii::$app->controller->action->id == 'about'): ?>

        <a class="header__nav-item" href="<?= Url::toRoute(['/']); ?>">Главная</a>
        <a class="header__nav-item" href="<?= Url::toRoute(['/#tarif']) ?>">Тарифы</a>
        <a class="header__nav-item " href="<?= Url::toRoute(['/#reviews']) ?>">Отзывы</a>
      <?php else: ?>
        <a class="header__nav-item" href="<?= Url::toRoute(['/site/about']); ?>">О сервисе</a>
        <a class="header__nav-item header__nav-item-scroll" href="#tarif">Тарифы</a>
        <a class="header__nav-item header__nav-item-scroll" href="#reviews">Отзывы</a>
      <?php endif; ?>

    <!--                    <a class="header__nav-item" href="#">Блог</a>-->
      <?php if (Yii::$app->user->isGuest): ?>
          <a href="<?= Url::toRoute(['/site/login']); ?>" class="btn btn-pink">Вход</a>
<!--        <a class="header__icon" href="--><?//= Url::toRoute(['/site/login']); ?><!--">-->
<!--          <img src="--><?//= $enterIcon ?><!--"/>-->
<!--        </a>-->
      <?php endif; ?>

      <?php if (!Yii::$app->user->isGuest): ?>
          <a href="<?= Url::toRoute(['/cabinet']); ?>" class="btn btn-pink">Кабинет</a>
<!--        <a class="header__icon" href="--><?//= Url::toRoute(['/cabinet']); ?><!--">-->
<!--          <img src="--><?//= $cabinetIcon ?><!--"/>-->
<!--        </a>-->
      <?php endif; ?>
  </div>
</div>