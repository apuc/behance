<?php
use yii\helpers\Url;
?>

<footer class="footer-wrap">
    <div class="container">
        <div class="footer offset-xl-1">
            <div class="footer__nav">
                <?php if(Yii::$app->controller->action->id == 'about'): ?>
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
                <a class="footer__btn" href="tel:">
                    <span class="footer__btn-round">
                        <i class="fa fa-phone"></i>
                    </span>
                    <span class="footer__btn-text">
                        <span class="fz15 fw-extra-bold">+8 812 319-36-02</span>
                        <span class="fz10 fw-medium">Заказать обратный звонок</span>
                    </span>
                </a>
                <a class="footer__btn" href="mailto:info@avtouzor.ru">
                    <span class="footer__btn-round">@</span>
                    <span class="footer__btn-text">
                        <span class="fz15 fw-extra-bold">info@avtouzor.ru</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</footer>