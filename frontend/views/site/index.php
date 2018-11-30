<?php

use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 */

$this->title = 'Behance Liker';
$this->registerCssFile('/css/main.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
?>


  <header class="header-wrap">
    <div class="header__stars1 header__stars">
      <div class="stars"></div>
      <div class="stars2"></div>
      <div class="stars3"></div>
    </div>
    <div class="container">
      <div class="header">
          <?= $this->render('header-menu'); ?>
        <div class="header__phone">
            <?= \frontend\widgets\BehancePhoneWidget::widget(['userIsGuest' => Yii::$app->user->isGuest]); ?>
          <div class="header__phone-text">
            <a class="btn btn-pink"
               href="<?= (Yii::$app->user->isGuest) ? Url::toRoute(['site/signup']) : Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                        <span class="btn-thumb">
                            <i class="fa fa-thumbs-up wow"></i>
                            <span class="btn-thumb-circle wow"></span>
                        </span>
              <span>получить <span class="fw-extra-bold"><span
                    class="btn-number"><?= (Yii::$app->user->isGuest) ? 50 : 100 ?></span> лайков</span>
                        </span>
            </a>
            <a class="header__more" href="<?= Url::toRoute(['/site/about']); ?>">Узнать подробнее</a>
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
                <h2 class="action__title title"><span class="title-light">небывалые высоты</span><span
                    class="title-extra-bold">твоего аккаунта</span>
                </h2>
                <h1 class="title-big">Behance</h1>
                <p class="main-text">Заказывая у нас услуги вы получаете беспрецедентную возможность подняться в поиске
                  сайта, получить ряд преимуществ над другими пользователями, попасть в топ исполнителей и значительно
                  поднять свой статус. Просмотры и лайки ваших работ растут, что повышает интерес к вам потенциальных
                  заказчиков.</p>
              </div>
            </div>
          </div>
          <div class="action__main">
            <div class="action__left">
              <div class="action__item">
                <div class="action__item-img"><img src="/images/icons/action1.png"/>
                </div>
                <div class="action__item-main"><span class="action__item-title">быстрая регистрации</span><span
                    class="action__item-text">Вам понадобится всего пара минут и Вы сможете воспользоваться возможностями нашего сервиса</span>
                </div>
              </div>
              <div class="action__item">
                <div class="action__item-img"><img src="/images/icons/action2.png"/>
                </div>
                <div class="action__item-main"><span class="action__item-title">Постоянные бонусы</span><span
                    class="action__item-text">Мы предлагаем широкий ассортимент готовых кейсов, но также и индивидуальный подход</span>
                </div>
              </div>
              <div class="action__item">
                <div class="action__item-img"><img src="/images/icons/action3.png"/>
                </div>
                <div class="action__item-main"><span class="action__item-title">невыносимо низкие цены</span><span
                    class="action__item-text">Наши цены разумные и аргументированы. Вы получаете 100% отдачу затраченных средств и намного больше - <span
                      class="fw-extra-bold">непрерывное движение вверх!</span></span>
                </div>
              </div>
              <div class="action__item">
                <div class="action__item-img"><img src="/images/icons/action4.png"/>
                </div>
                <div class="action__item-main"><span class="action__item-title">соблюдение сроков</span><span
                    class="action__item-text">Предварительно с вами утверждается план работ и продвижение выполняется в строгом соответствии, после чего составляется отчет.</span>
                </div>
              </div>
            </div>
            <div class="action__right">
              <div class="action__img">
                <div class="action__img-text"><span
                    class="fw-extra-bold js-number">11,470</span><span>просмотров!</span>
                </div>
                <img src="/images/girl.png"/>
              </div>
            </div>
          </div>
          <div class="action__bottom"><span class="action__bottom-text">Хочу принять участие в акции</span>
            <div class="btn-arrow">
              <svg class="arrow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                   xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9"
                   style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow"
      d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1"/>
                <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1 wow"
                      d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58"/>
                <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2 wow"
                      d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9"/>
</svg>
              <a
                href="<?= (Yii::$app->user->isGuest) ? Url::toRoute(['site/signup']) : Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                <button class="btn btn-pink"><span>получить <span class="fw-extra-bold">
                                        <span class="btn-number"><?= (Yii::$app->user->isGuest) ? 50 : 100 ?></span> лайков</span></span>
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="prices-wrap" id="tarif">
      <div class="stars-wrap prices-stars">
        <div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
        <img class="prices-comet1" src="/images/comet1.png"/>
      </div>
      <div class="container">
        <div class="prices">
          <div class="col-xl-9 offset-xl-2">
            <h2 class="title"><span class="title-light">Ищите качественные</span><span class="title-extra-bold">услуги по продвижению?</span>
            </h2>
            <p class="main-text offset-xl-1">Низкие цены на продвижение своих работ на Behance? Вы нашли, чтоискали! У
              нас вы получаете комплексное индивидуальное продвижение по максимально выгодным ценам!</p>
          </div>
          <div class="prices__items">
            <img class="prices__img-drop" src="/images/drop.png" alt="" role="presentation"/>
              <?php if (isset($cases)): ?>
                  <?php $i = 0;
                  foreach ($cases as $case): $i++; ?>
                    <div class="prices__item-wrap">
                      <div class="prices__item <?= ($i == count($cases)) ? 'prices__item-pink' : '' ?>">
                        <div class="prices__item-img">
                          <img src="<?= $case->img ?>"/>
                        </div>
                        <span class="prices__item-title mb20">
					                    <?= $case->name ?>
				                    </span>
                        <span>
					                    <?= $case->likes ?> лайков
				                    </span>
                        <span class="mb20">
					                    <?= $case->views ?> просмотров
				                    </span>
                        <span class="mb20">делаем за
                            <?= $case->term ?>
				                    </span>
                        <span class="prices__item-price mb20">
					                    <?= str_replace('.00', '', $case->price) ?>
                          <span class="prices__item-ruble">₽</span>
				                    </span>
                        <a class="btn btn-small btn-white" href="<?=Url::toRoute(['/cabinet/payment'])?>">Заказать</a>

                      </div>
                    </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <section class="reviews-wrap" id="reviews">
      <div class="container">
        <div class="reviews">
          <div class="d-flex justify-content-center">
            <h2 class="title"><span class="title-light">Что говорят наши</span><span class="title-extra-bold">Довольные клиенты</span>
            </h2>
          </div>
          <div class="reviews__slider">
              <?php if (isset($reviews)): ?>
                  <?php foreach ($reviews as $review): ?>
                  <div class="reviews__slider-item">
                    <div class="reviews__slider-top">
                      <div class="reviews__slider-photo">
                        <img src="<?= $review->photo ?>"/>
                      </div>
                      <div class="reviews__slider-info"><span><?= $review->name ?></span><span
                          class="fw-extra-bold"><?= $review->nick_name ?></span>
                      </div>
                    </div>
                    <p class="reviews__slider-text">
                        <?= $review->content ?>
                    </p>
                  </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
      <?= $this->render('contact'); ?>
  </main>



<?= $this->render('footer'); ?>