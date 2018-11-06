<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="root">
    <header class="header-wrap">
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
        <div class="container">
            <div class="header">
                <div class="header__menu">
                    <div class="header__left"><a class="header__menu-btn" href="#"><span class="header__menu-btn-round">@</span><span class="header__menu-btn-text"><span class="fz12 fw-extra-bold">info@avtouzor.ru</span></span></a><a class="header__menu-btn" href="#"><span class="header__menu-btn-round"><i class="fa fa-phone"></i></span><span class="header__menu-btn-text"><span class="fz12 fw-extra-bold">+8 812 319-36-02</span><span class="fz8 fw-medium">Заказать обратный звонок</span></span></a>
                    </div>
                    <div class="header__right">
                        <nav class="header__nav">
                        </nav><a class="header__nav-item" href="#">О сервисе</a><a class="header__nav-item" href="#">Тарифы</a><a class="header__nav-item" href="#">Отзывы</a><a class="header__nav-item" href="#">Блог</a><a class="header__icon" href="#"><img src="/images/icons/ico-enter.png"/></a><a class="header__icon" href="#"><img src="/images/icons/ico-user.png"/></a>
                    </div>
                </div>
                <div class="header__phone">
                    <div class="header__phone-wrap"><img class="header__phone-img" src="/images/phone.png" alt="" role="presentation"/>
                        <div class="header__phone-info"><span class="header__phone-name">Ekaterina Boyko</span>
                            <div class="header__phone-main">
                                <div class="header__phone-avatar"><img src="/images/girl.png"/>
                                </div>
                                <div class="d-flex flex-column"><span>Graphic designer</span><span>Craft Group</span><span class="c-gray mt-1"><i class="fa fa-map-marker"></i>Moscow, Russian Federation</span><span class="c-gray mt-1 text-underline">https://vk.com/kotya_ka</span></div>
                            </div>
                            <div class="d-flex justify-content-between pr-2">
                                <div class="header__phone-btn header__phone-btn-blue">Следить
                                </div>
                                <div class="header__phone-btn"><i class="fa fa-envelope"></i> Сообщение
                                </div>
                            </div>
                            <div class="d-flex mb-4"><span class="pr-4">Инф</span><span class="pr-4">Проекты</span><span class="pr-4">Коллекции</span><span>Стена</span></div>
                            <div class="d-flex flex-wrap">
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png"/>
                                    </div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png"/>
                                    </div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png"/>
                                    </div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png"/>
                                    </div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header__phone-text"><a class="btn btn-pink" href="#"><span class="btn-thumb"><i class="fa fa-thumbs-up wow"></i><span class="btn-thumb-circle wow"></span></span><span>получить <span class="fw-extra-bold"><span class="btn-number">100</span> лайков</span></span></a><a class="header__more" href="#">Узнать подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
        <?= $content ?>

    <footer class="footer-wrap">
        <div class="container">
            <div class="footer offset-xl-1">
                <div class="footer__nav"><a class="footer__nav-item" href="#">Кейсы</a><a class="footer__nav-item" href="#">Контакты</a><a class="footer__nav-item" href="#">Акции</a><a class="footer__nav-item" href="#">Отзывы</a>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-center"><a class="footer__btn" href="#"><span class="footer__btn-round"><i class="fa fa-phone"></i></span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">+8 812 319-36-02</span><span class="fz10 fw-medium">Заказать обратный звонок</span></span></a><a class="footer__btn" href="#"><span class="footer__btn-round">@</span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">info@avtouzor.ru</span></span></a>
                </div>
            </div>
        </div>
    </footer>

</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
