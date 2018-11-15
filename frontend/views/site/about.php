<?php
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 */

$this->title = 'О сервисе';
$this->registerCssFile('/css/service.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

?>


<div class="root">
    <header class="header-small-wrap">
        <div class="header__stars1 header__stars">
            <div class="stars"></div>
            <div class="stars2"></div>
            <div class="stars3"></div><img src="/images/header-bg3.png" alt=""/>
        </div>
        <div class="header">
            <div class="container">
                <div class="header__menu">
                    <div class="header__left"><a class="header__menu-btn" href="#"><span class="header__menu-btn-round">@</span><span class="header__menu-btn-text"><span class="fz12 fw-extra-bold">info@avtouzor.ru</span></span></a><a class="header__menu-btn" href="#"><span class="header__menu-btn-round"><i class="fa fa-phone"></i></span><span class="header__menu-btn-text"><span class="fz12 fw-extra-bold">+8 812 319-36-02</span><span class="fz8 fw-medium">Заказать обратный звонок</span></span></a>
                    </div>
                    <div class="header__right">
                        <nav class="header__nav">
                        </nav><a class="header__nav-item" href="#">О сервисе</a><a class="header__nav-item" href="#">Тарифы</a><a class="header__nav-item" href="#">Отзывы</a><a class="header__nav-item" href="#">Блог</a><a class="header__icon" href="#"><img class="icon-blue" src="/images/icons/ico-enter-blue.png" alt=""/><img class="icon-white" src="/images/icons/ico-enter.png" alt=""/></a><a class="header__icon" href="#"><img class="icon-blue" src="/images/icons/ico-user-blue.png" alt=""/><img class="icon-white" src="/images/icons/ico-user.png" alt=""/></a>
                    </div>
                </div>
                <div class="header__phone">
                    <div class="header__phone-wrap"><img class="header__phone-img" src="/images/phone.png" alt=""/>
                        <div class="header__phone-info"><span class="header__phone-name">Ekaterina Boyko</span>
                            <div class="header__phone-main">
                                <div class="header__phone-avatar"><img src="/images/girl.png" alt=""/></div>
                                <div class="d-flex flex-column"><span>Graphic designer</span><span>Craft Group</span><span class="c-gray mt-1"><i class="fa fa-map-marker"></i>Moscow, Russian Federation</span><span class="c-gray mt-1 text-underline">https://vk.com/kotya_ka</span></div>
                            </div>
                            <div class="d-flex justify-content-between pr-2">
                                <div class="header__phone-btn header__phone-btn-blue">Следить</div>
                                <div class="header__phone-btn"><i class="fa fa-envelope"></i> Сообщение</div>
                            </div>
                            <div class="d-flex mb-4"><span class="pr-4">Инф</span><span class="pr-4">Проекты</span><span class="pr-4">Коллекции</span><span>Стена</span></div>
                            <div class="d-flex flex-wrap">
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png" alt=""/></div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png" alt=""/></div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png" alt=""/></div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                                <div class="header__phone-item">
                                    <div class="header__phone-item-img"><img src="/images/girl.png" alt=""/></div><span class="font-weight-bold mb-2">Креативый дизайн буклета детского клуба</span><span>Ekaterina Boyko</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header__phone-text"><a class="btn btn-pink" href="#"><span class="btn-thumb"><i class="fa fa-thumbs-up wow"></i><span class="btn-thumb-circle wow"></span></span><span>получить <span class="fw-extra-bold"><span class="btn-number">100</span> лайков</span></span></a><a class="header__more" href="#">Узнать подробнее</a></div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <section class="about-wrap">
            <div class="container">
                <div class="about">
                    <div class="about__title">
                        <h2 class="title d-inline-block ml-auto"><span class="title-light mb-0">узнай больше</span><span class="title-extra-bold">и начни зарабатывыать</span></h2>
                        <h1 class="title-big title-big-second">О сервисе</h1>
                    </div>
                    <div class="about__main-text main-text">
                        <p>Выйти на новый уровень дизайнеру поможет Behance — ресурс, где с хорошим портфолио и рейтинговым кол-вом лайков / просмотров предложения о сотрудничестве будут приходить сами без долгих дополнительных поисков.</p>
                        <p>Наш сервис это не просто  «накрутка», мы делаем уникальное продвижение ваших работ по разработанному алгоритму, которое позволяет увеличить лайки аккаунта и единичной работы до 3000 и просмотры до 10000, благодаря чему Ваш проект попадает в недельный ТОП Behance и получает ряд преимуществ:</p>
                    </div>
                    <div class="about__main">
                        <div class="about__main-left">
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Как можно больше активности </span><span class="action__item-text">от пользователей Behance (лайки, подписки и добавление работ в коллекции)
Коментарии и адекватную критику своих работ а так же выгодно выделиться
на фоне новичков.</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Получте уже сейчас</span><span class="action__item-text">коммерческие заказы  / предложения долгосрочного сотрудничества
и начните зарабатывать на своих работах не прилогая усилий</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">вывод в топ</span><span class="action__item-text">Возможность быстрее других своих коллег попасть в ТОП, Вероятность что
кураторы Behance добавят Вашу работу в одну из курируемых галерей
возрастает (behance.net/galleries)
</span></div>
                            </div>
                            <div class="about__bottom action__bottom"><span class="action__bottom-text">Хочу принять участие в акции</span>
                                <div class="btn-arrow"><svg class="arrow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
                                        <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1 wow" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
                                        <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2 wow" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
</svg>
                                    <button class="btn btn-pink"><span>получить <span class="fw-extra-bold"><span class="btn-number">50</span> лайков</span></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="about__main-right">
                            <div class="action__right">
                                <div class="action__img">
                                    <div class="action__img-text"><span class="fw-extra-bold js-number">11,470</span><span>просмотров!</span></div><img src="/images/girl.png" alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="callback-wrap">
            <div class="callback-bg">
                <div class="stars-wrap callback-stars1">
                    <div class="stars"></div>
                    <div class="stars2"></div>
                    <div class="stars3"></div><img class="callback-comet1" src="/images/comet2.png" alt=""/>
                </div>
                <div class="stars-wrap callback-stars2">
                    <div class="stars"></div>
                    <div class="stars2"></div>
                    <div class="stars3"></div><img class="callback-comet2" src="/images/comet3.png" alt=""/>
                </div><img class="callback__img-bg" src="/images/chat.png" alt=""/>
            </div>
            <div class="container">
                <div class="callback">
                    <div class="no-gutters">
                        <div class="col-xl-7 col-lg-9">
                            <h2 class="title"><span class="title-light">Наслаждайтесь творчеством</span><span class="title-extra-bold">остальное доверьте нам!</span></h2>
                            <p class="callback__main-text main-text">Низкие цены на продвижение своих работ на Behance? Вы нашли, чтоискали! У нас вы получаете комплексное индивидуальное продвижение по максимально выгодным ценам!
                            </p>
                            <form class="callback__form">
                                <input placeholder="Ваше имя"/>
                                <input placeholder="Ваш e-mail"/>
                                <input class="mb-3" placeholder="Ссылка на Ваше портфолио"/>
                                <textarea class="mb-3" placeholder="Ваше сообщение"></textarea>
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
                                    <button class="btn btn-pink"><span><span class="fw-extra-bold">оформить</span> заказ</span></button>
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
                <div class="d-flex flex-wrap align-items-center justify-content-center"><a class="footer__btn" href="#"><span class="footer__btn-round"><i class="fa fa-phone"></i></span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">+8 812 319-36-02</span><span class="fz10 fw-medium">Заказать обратный звонок</span></span></a><a class="footer__btn" href="#"><span class="footer__btn-round">@</span><span class="footer__btn-text"><span class="fz15 fw-extra-bold">info@avtouzor.ru</span></span></a>
                </div>
            </div>
        </div>
    </footer>
</div>

