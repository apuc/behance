<?php
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 */

$this->title = 'My Yii Application';
?>


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
                <div class="header__left">
                    <a class="header__menu-btn" href="mailto:info@avtouzor.ru">
                        <span class="header__menu-btn-round">@</span>
                        <span class="header__menu-btn-text">
                            <span class="fz12 fw-extra-bold">info@avtouzor.ru</span>
                        </span>
                    </a>
                    <a class="header__menu-btn" href="tel:">
                        <span class="header__menu-btn-round">
                            <i class="fa fa-phone"></i>
                        </span>
                        <span class="header__menu-btn-text">
                            <span class="fz12 fw-extra-bold">+8 812 319-36-02</span>
                            <span class="fz8 fw-medium">Заказать обратный звонок</span>
                        </span>
                    </a>
                </div>
                <div class="header__right">
                    <nav class="header__nav">
                    </nav>
                    <a class="header__nav-item" href="#services">О сервисе</a>
                    <a class="header__nav-item" href="#tarif">Тарифы</a>
                    <a class="header__nav-item" href="#reviews">Отзывы</a>
<!--                    <a class="header__nav-item" href="#">Блог</a>-->
                    <?php if(Yii::$app->user->isGuest):?>
                    <a class="header__icon" href="<?= Url::toRoute(['/site/login']); ?>">
                        <img src="/images/icons/ico-enter.png"/>
                    </a>
                    <?php endif; ?>

                    <?php if(!Yii::$app->user->isGuest):?>
                    <a class="header__icon" href="<?= Url::toRoute(['/cabinet']); ?>">
                        <img src="/images/icons/ico-user.png"/>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="header__phone">
                <div class="header__phone-wrap">
                    <img class="header__phone-img" src="/images/phone.png" alt="" role="presentation"/>
                    <div class="header__phone-info">
                        <?php if(Yii::$app->user->isGuest): ?>
                            <span class="header__phone-name">Ekaterina Boyko</span>
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
                        <?php endif; ?>

                        <?php if(!Yii::$app->user->isGuest): ?>
                             <?php if($phone_account): ?>
                            <span class="header__phone-name"><?= $phone_account->display_name; ?></span>
                            <div class="header__phone-main">
                                <div class="header__phone-avatar"><img src="<?= $phone_account->image; ?>"/>
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
                            <?php else: ?>
                                <span class="header__phone-name">Ekaterina Boyko</span>
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
                            <?php endif; // if($phone_account)?>
                                 <?php if($phone_works): ?>
                                <div class="d-flex flex-wrap">
                                   <?php foreach($phone_works as $w): ?>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="<?=$w->image?>"/>
                                    </div><span class="font-weight-bold mb-2"><?=$w->name?></span><span><?= $phone_account->display_name; ?></span>
                                </div>
                                  <?php endforeach; ?>
                                </div>
                                     <?php else: ?>
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
                                <?php endif;// if($phone_works)?>
                        <?php endif; //if(!Yii::$app->user->isGuest) ?>

                    </div>
                </div>
                <div class="header__phone-text"><a class="btn btn-pink" href="#"><span class="btn-thumb"><i class="fa fa-thumbs-up wow"></i><span class="btn-thumb-circle wow"></span></span><span>получить <span class="fw-extra-bold"><span class="btn-number">100</span> лайков</span></span></a><a class="header__more" href="#">Узнать подробнее</a>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="main">
    <section class="action-wrap" id="services">
        <div class="container">
            <div class="action">
                <div class="action__title-wrap row">
                    <div class="no-gutters">
                        <div class="col-xl-8 offset-xl-2">
                            <h2 class="action__title title"><span class="title-light">небывалые высоты</span><span class="title-extra-bold">твоего аккаунта</span>
                            </h2>
                            <h1 class="title-big">Behance</h1>
                            <p class="main-text">Заказывая у нас услуги вы получаете беспрецедентную возможность подняться в поиске сайта, получить ряд преимуществ над другими пользователями, попасть в топ исполнителей и значительно поднять свой статус. Просмотры и лайки ваших работ растут, что повышает интерес к вам потенциальных заказчиков.</p>
                        </div>
                    </div>
                </div>
                <div class="action__main">
                    <div class="action__left">
                        <div class="action__item">
                            <div class="action__item-img"><img src="/images/icons/action1.png"/>
                            </div>
                            <div class="action__item-main"><span class="action__item-title">быстрая регистрации</span><span class="action__item-text">Вам понадобится всего пара минут и Вы сможете воспользоваться возможностями нашего сервиса</span>
                            </div>
                        </div>
                        <div class="action__item">
                            <div class="action__item-img"><img src="/images/icons/action2.png"/>
                            </div>
                            <div class="action__item-main"><span class="action__item-title">Постоянные бонусы</span><span class="action__item-text">Мы предлагаем широкий ассортимент готовых кейсов, но также и индивидуальный подход</span>
                            </div>
                        </div>
                        <div class="action__item">
                            <div class="action__item-img"><img src="/images/icons/action3.png"/>
                            </div>
                            <div class="action__item-main"><span class="action__item-title">невыносимо низкие цены</span><span class="action__item-text">Наши цены разумные и аргументированы. Вы получаете 100% отдачу затраченных средств и намного больше - <span class="fw-extra-bold">непрерывное движение вверх!</span></span>
                            </div>
                        </div>
                        <div class="action__item">
                            <div class="action__item-img"><img src="/images/icons/action4.png"/>
                            </div>
                            <div class="action__item-main"><span class="action__item-title">соблюдение сроков</span><span class="action__item-text">Предварительно с вами утверждается план работ и продвижение выполняется в строгом соответствии, после чего составляется отчет.</span>
                            </div>
                        </div>
                    </div>
                    <div class="action__right">
                        <div class="action__img">
                            <div class="action__img-text"><span class="fw-extra-bold js-number">11,470</span><span>просмотров!</span>
                            </div><img src="/images/girl.png"/>
                        </div>
                    </div>
                </div>
                <div class="action__bottom"><span class="action__bottom-text">Хочу принять участие в акции</span>
                    <div class="btn-arrow"><svg class="arrow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1 wow" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2 wow" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
</svg>
                        <button class="btn btn-pink"><span>получить <span class="fw-extra-bold"><span class="btn-number">50</span> лайков</span></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prices-wrap" id="tarif">
        <div class="stars-wrap prices-stars">
            <div id="stars"></div>
            <div id="stars2"></div>
            <div id="stars3"></div><img class="prices-comet1" src="/images/comet1.png"/>
        </div>
        <div class="container">
            <div class="prices">
                <div class="col-xl-9 offset-xl-2">
                    <h2 class="title"><span class="title-light">Ищите качественные</span><span class="title-extra-bold">услуги по продвижению?</span></h2>
                    <p class="main-text offset-xl-1">Низкие цены на продвижение своих работ на Behance? Вы нашли, чтоискали! У нас вы получаете комплексное индивидуальное продвижение по максимально выгодным ценам!</p>
                </div>
                <div class="prices__items"><img class="prices__img-drop" src="/images/drop.png" alt="" role="presentation"/>
                    <div class="prices__item-wrap">
                        <div class="prices__item">
                            <div class="prices__item-img"><img src="/images/icons/ico-paper-plane.png"/>
                            </div><span class="prices__item-title mb20">Light Start</span><span>100 лайков</span><span class="mb20">1000 просмотров</span><span class="mb20">делаем за 1 день</span><span class="prices__item-price mb20">500<span class="prices__item-ruble">₽</span></span>
                            <button class="btn btn-small btn-white">Заказать</button>
                        </div><span class="prices__item-after">При регистрации <span class="fw-extra-bold">БЕСПЛАТНО</span></span>
                    </div>
                    <div class="prices__item-wrap">
                        <div class="prices__item">
                            <div class="prices__item-img"><img src="/images/icons/ico-plane.png"/>
                            </div><span class="prices__item-title mb20">Start</span><span>250 лайков</span><span class="mb20">2000 просмотров</span><span class="mb20">делаем за 1-2 день</span><span class="prices__item-price mb20">1 000<span class="prices__item-ruble">₽</span></span>
                            <button class="btn btn-small btn-white">Заказать</button>
                        </div>
                    </div>
                    <div class="prices__item-wrap">
                        <div class="prices__item">
                            <div class="prices__item-img"><img src="/images/icons/ico-rocket.png"/>
                            </div><span class="prices__item-title mb20">Fast Start</span><span>100 лайков</span><span class="mb20">5000 просмотров</span><span class="mb20">делаем за 5-6 день</span><span class="prices__item-price mb20">2 000<span class="prices__item-ruble">₽</span></span>
                            <button class="btn btn-small btn-white">Заказать</button>
                        </div>
                    </div>
                    <div class="prices__item-wrap">
                        <div class="prices__item prices__item-pink">
                            <div class="prices__item-img"><img src="/images/icons/ico-diamond.png"/>
                            </div><span class="prices__item-title mb20">maximum</span><span>2000 лайков</span><span class="mb20">10 000 просмотров</span><span class="mb20">делаем за 10 день</span><span class="prices__item-price mb20">5 000<span class="prices__item-ruble">₽</span></span>
                            <button class="btn btn-small btn-white-on-pink">Заказать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="reviews-wrap" id="reviews">
        <div class="container">
            <div class="reviews">
                <div class="d-flex justify-content-center">
                    <h2 class="title"><span class="title-light">Что говорят наши</span><span class="title-extra-bold">Довольные клиенты</span></h2>
                </div>
                <div class="reviews__slider">
	                <?php if(isset($reviews)):?>
		                <?php foreach ($reviews as $review):?>
	                        <div class="reviews__slider-item">
	                        <div class="reviews__slider-top">
	                            <div class="reviews__slider-photo">
		                            <img src="<?=$review->photo?>"/>
	                            </div>
	                            <div class="reviews__slider-info"><span><?=$review->name?></span><span class="fw-extra-bold"><?=$review->nick_name?></span>
	                            </div>
	                        </div>
	                        <p class="reviews__slider-text">
		                        <?=$review->content?>
	                        </p>
	                    </div>
		                <?php endforeach;?>
	                <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <section class="callback-wrap">
        <div class="callback-bg">
            <div class="stars-wrap callback-stars1">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div><img class="callback-comet1" src="/images/comet2.png"/>
            </div>
            <div class="stars-wrap callback-stars2">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div><img class="callback-comet2" src="/images/comet3.png"/>
            </div><img class="callback__img-bg" src="/images/chat.png"/>
        </div>
        <div class="container">
            <div class="callback">
                <div class="no-gutters">
                    <div class="col-xl-7 col-lg-9">
                        <h2 class="title"><span class="title-light">Наслаждайтесь творчеством</span><span class="title-extra-bold">остальное доверьте нам!</span></h2>
                        <p class="callback__main-text main-text">Низкие цены на продвижение своих работ на Behance? Вы нашли, чтоискали! У нас вы получаете комплексное индивидуальное продвижение по максимально выгодным ценам!
                        </p>
                        <form class="callback__form" method="post">
                            <input placeholder="Ваше имя" name="name" required/>
                            <input placeholder="Ваш e-mail" name="email" required type="email"/>
                            <input class="mb-3" placeholder="Ссылка на Ваше портфолио" name="link" type="url" required/>
                            <textarea class="mb-3" placeholder="Ваше сообщение" name="message"></textarea>
                            <div class="checkbox-wrap mb-3">
                                <input type="checkbox" id="agree"/>
                                <div class="checkbox">
                                    <div class="checkbox-ico"></div>
                                </div>
                                <label for="agree">Я принимаю условия <a href="#">Соглашения</a></label>
                            </div>
                            <div class="btn-arrow"><svg class="arrow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
                                    <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1 wow" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
                                    <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2 wow" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
</svg>
                                <button type="submit" id="contact-submit" disabled class="btn btn-pink"><span><span class="fw-extra-bold">оформить</span> заказ</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<footer class="footer-wrap">
    <div class="container">
        <div class="footer offset-xl-1">
            <div class="footer__nav"><a class="footer__nav-item" href="#">Кейсы</a><a class="footer__nav-item" href="#">Контакты</a><a class="footer__nav-item" href="#">Акции</a><a class="footer__nav-item" href="#">Отзывы</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-center"><a class="footer__btn" href="tel:"><span class="footer__btn-round"><i class="fa fa-phone"></i></span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">+8 812 319-36-02</span><span class="fz10 fw-medium">Заказать обратный звонок</span></span></a><a class="footer__btn" href="mailto:info@avtouzor.ru"><span class="footer__btn-round">@</span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">info@avtouzor.ru</span></span></a>
            </div>
        </div>
    </div>
</footer>