<?php

use yii\helpers\Url;

?>

<footer class="footer-wrap">
  <div class="container">
    <div class="footer offset-xl-1">
      <div class="footer__nav">
          <?php if (Yii::$app->controller->action->id == 'about'): ?>
            <a class="footer__nav-item" href="<?= Url::toRoute(['/#tarif']) ?>">Тарифы</a>
            <a class="footer__nav-item" href="<?= Url::toRoute(['site/about']) ?>">О сервисе</a>
            <a class="footer__nav-item" href="<?= Url::toRoute(['/#reviews']) ?>">Отзывы</a>
          <?php else: ?>
            <a class="footer__nav-item footer__nav-item-scroll" href="#tarif">Тарифы</a>
            <a class="footer__nav-item" href="<?= Url::toRoute(['site/about']) ?>">О сервисе</a>
            <a class="footer__nav-item footer__nav-item-scroll" href="#reviews">Отзывы</a>
          <?php endif; ?>
      </div>
      <div class="d-flex flex-wrap align-items-center justify-content-center">
        <div class="footer__btn">
          <div class="footer__btn-round">
              <i class="fa fa-phone"></i>
          </div>

          <div class="footer__btn-text">
            <a class="header__btn fz12 fw-extra-bold" href="tel:+8 812 319-36-02">+7 928 770 19 79</a>
            <button class="header__btn fz10 fw-medium js-backCall" type="button">Заказать обратный звонок</button>
          </div>
        </div>

        <a class="footer__btn" href="mailto:info@avtouzor.ru">
          <span class="footer__btn-round">@</span>
          <span class="footer__btn-text">
                        <span class="fz15 fw-extra-bold">info@behance.space</span>
                    </span>
        </a>

          <a class="footer__btn">

              <span class="footer__btn-text">
                        <a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/14.png"></a>
                    </span>
          </a>

      </div>
    </div>
  </div>
</footer>

<div class="modal-callback js-modal">
    <div class="modal-callback__backdrop js-close-modal"></div>

    <div class="form__block form__main">
        <div class="callback callback_modal">
            <button class="form__close js-close-modal">
                <span></span><span></span>
            </button>

            <div class="modal-callback__container">
                <h3 class="modal-callback__title">Заказать звонок</h3>

                <p class="modal-callback__text">Оставьте номер и мы вам перезвоним</p>

                <form class="modal-callback__form">
                    <input class="modal-callback__input js-callBackTel" placeholder="Номер телефона*" name="tel" required type="tel"/>

                    <div class="btn-arrow btn-arrow_callback">
                        <svg class="arrow-svg arrow-svg_callback" version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9"
                             style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow"
      d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1 wow"
                                  d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58"/>
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2 wow"
                                  d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9"/>
</svg>
                        <button disabled class="btn btn-pink btn_callback js-callback">Жду звонка</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-callback js-modalError">
    <div class="modal-callback__backdrop js-close-modal"></div>

    <div class="form__block form__main">
        <div class="callback callback_modal">
            <button class="form__close js-close-modal">
                <span></span><span></span>
            </button>

            <div class="modal-callback__container">
                <h3 class="modal-callback__title modal-callback__title_error">Ошибка</h3>

                <img src="/images/circle.png" alt="">

                <p class="modal-callback__text modal-callback__text_error">Вы ввели неверные данные. Вернитесь и заполните форму верно.</p>
            </div>
        </div>
    </div>
</div>