<?php
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 */


$this->title = 'О сервисе';

if($seo)
{
    $meta = json_decode($seo->value);

    $this->registerMetaTag([
        'name' => 'description',
        'content' => $meta->descr
    ]);

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $meta->keywords
    ]);

    $this->title = $meta->title;
}

$this->registerCssFile('/css/styles.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
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
                <?= $this->render('header-menu'); ?>
                <div class="header__phone">
                    <img class="header__phone-img" src="/images/new-phone.png" alt="" role="presentation">
                    <div class="header__phone-text" style=" left: 220px; ">
                        <a class="btn btn-pink"
                           href="<?= (Yii::$app->user->isGuest) ? Url::toRoute(['site/signup']) : Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                            <span class="btn-thumb">
                                <i class="fa fa-thumbs-up wow"></i>
                                <span class="btn-thumb-circle wow"></span>
                            </span>
                            <span>получить <span class="fw-extra-bold"><!--<span
                                            class="btn-number"><?/*= (Yii::$app->user->isGuest) ? 50 : 100; */?></span> лайков</span></span>-->
                                    <span
                                            class="btn-number">50</span> лайков</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <section class="about-wrap">
            <div class="container">
                <div class="about">
                    <div class="about__title">
                        <h2 class="title d-inline-block ml-auto title-light mb-0">Будь в ТОПе</h2>
                        <h1 class="title-big title-big-second">О сервисе</h1>
                    </div>
                    <div class="about__main-text main-text">
                        <p>Выйти на новый уровень и получить признание аудитории длительный и сложный процесс. Что бы это ускорить воспользуйтесь сервисом Betop! Мы предоставляем услуги продвижения страниц во всех социальных сетях путем накручивания лайков и подписчиков на страницу. Все пользователи которые совершат действия, будь то лайк или подписка – реальные! Страницы от имени которого происходит действие – реальная, имеет ежедневный онлайн и активность, а так-же друзей. </p>
                        <p>А еще, при оформлении заказа Вы можете выбрать аудиторию и получить лайки и подписчиков именно Вашей целевой аудитории! Круто, не правда ли? </p>
                        <p>Мы не нарушаем правила и лимиты социальных сетей, блокировки страницы не будет, и это гарантированно! </p>
                    </div>
                    <div class="about__main">
                        <div class="about__main-left">
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Больше активности</span><span class="action__item-text">Покупая у нас подписчиков или лайки, Вы получаете широкий охват своего аккаунта, что гарантирует приток новых подписчиков, комментариев и если Вы продаете – продаж!</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Получаете уже сейчас</span><span class="action__item-text">Выполнение заказа начинается моментально. Оформили заказ – он уже в работе!</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Вывод в ТОП</span><span class="action__item-text">Накручивайте активность на страницу и выходите в ТОП поиска в своей нише! Не важно, Вы блогер, безнесмен или маркетолог, активность на странице это то что Вам нужно!
</span></div>
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
        <?= $this->render('contact'); ?>
    </main>

    <?= $this->render('footer'); ?>
</div>

