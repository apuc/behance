<?php

use common\models\PageSocials;
use common\models\Settings;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 * @var $seo Settings
 * @var $socials PageSocials[]
 */

$this->title = 'Betop.space';

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

?>


  <header class="header-small-wrap">
    <div class="header__stars1 header__stars">
      <div class="stars"></div>
      <div class="stars2"></div>
      <div class="stars3"></div><img src="/images/header-bg3.png" alt="">
    </div>
    <div class="header">
      <div class="container">
          <?= $this->render('header-menu'); ?>
      </div>
    </div>
  </header>

  <main class="main">
      <section class="about-wrap">
          <div class="container">
              <div class="about">
                  <div class="about__title">
                      <h2 class="title title-light mb-0">
                          <img src="/images/icons/icon-info.png" class="icon-info" alt="">
                          <span>
                                Здесь работают только реальные пользователи с реальными IP адресами и действующими аккаунтами соц сетей.
                            </span>
                      </h2>
                      <h1 class="title-big title-big-second">Услуги накрутки
                          <span class="title-big-second__under-descr">от Betop.space</span>
                      </h1>
                  </div>

                  <div class="about__main-items">
                      <?php
                        foreach ($socials as $social) { ?>
                            <div class="item">
                                <div class="item-header">
                                    <img src="<?= $social->social_icon ?>" alt="">
                                    <p class="item-title <?= $social->social_css ?>"><?= $social->social_title ?></p>
                                </div>

                                <div class="item-description">
                                    <?php
                                    foreach ($social->pageSocialsServices as $service) { ?>
                                        <p><a href="<?= $service->service_page_link ?>"><?= $service->service_title ?></a></p>
                                    <?php } ?>
                                </div>
                            </div>
                      <?php } ?>
                  </div>

              </div>
          </div>
      </section>
      <?= $this->render('contact'); ?>
  </main>



<?= $this->render('footer'); ?>