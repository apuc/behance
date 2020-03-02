<?php

use common\models\PageSocials;
use common\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 * @var $seo Settings
 * @var $social PageSocials
 * @var $service \common\models\PageSocialsServices
 */

$this->title = 'Betop.space';

$meta = json_decode($service->service_seo);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta->descr
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $meta->keywords
]);

$this->title = $meta->title;

$this->registerCssFile('/css/social/styles.css')
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
        <div class="container">
            <div class="about__title">
                <h2 class="title title-light mb-0">
                    <img src="/images/icons/icon-info.png" class="icon-info" alt="">
                    <span>
                                Здесь работают только реальные пользователи с реальными IP адресами и действующими аккаунтами соц сетей.
                          </span>
                </h2>
                <h1 class="title-big title-big-second"><?= $service->service_title ?>
                </h1>
            </div>
            <div class="container_content">
                <div class="container_content_logo">
                    <img src="<?= $social->social_icon ?>" alt="">
                </div>
                <header><?= $service->service_title ?></header>
                <div class="container_content_info">
                    <div class="container_content_info_text">
                        <?= $service->service_description ?>
                    </div>
                    <div class="container_content_info_list">
                        <ul>
                            <?php
                            foreach ($social->pageSocialsServices as $serv) {
                                if ($serv->id != $service->id) { ?>
                                    <li><a href="<?= Url::to(['new-main/social/'.$serv->service_page_link]) ?>"><?= $serv->service_title ?></a><li>
                            <?php }} ?>
                        </ul>
                    </div>
                    <div class="container_content_info_img">
                        <div class="action__img">
                            <div class="action__img-text"><span
                                        class="fw-extra-bold js-number">11,470</span><span>просмотров!</span>
                            </div>
                            <img src="/images/girl.png"/>
                        </div>
                        <div class="img-block heart">
                            <svg version="1.1" id="Objects" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20.2 17.6" xml:space="preserve">
							<path d="M18.7,1.9c-2.3-2.5-6.2-2.6-8.6-0.2C7.7-0.6,3.8-0.6,1.5,1.9c-2.2,2.4-1.9,6,0.3,8.3l6.6,6.6c0.9,0.9,2.4,0.9,3.3,0l6.6-6.6
								C20.6,8,20.8,4.3,18.7,1.9z"/>
							</svg>
                        </div>
                        <div class="img-block like">
                            <svg version="1.1" id="Objects" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12.4 13.7" xml:space="preserve">
							<path d="M5.6,0.1C4.9-0.2,4.1,0,3.8,0.7c0,0-0.8,2-2.3,4.1l-1.3,0C0.1,4.9,0,5,0,5.1l0,6.7C0,11.9,0.1,12,0.2,12l1,0
								c0.6,1.1,1.7,1.7,2.9,1.7l0.6,0l3.7,0l0.8,0c0.7,0,1.4-0.6,1.4-1.4c0-0.4-0.2-0.7-0.4-1l0.6,0c0.7,0,1.4-0.6,1.4-1.4
								c0-0.4-0.2-0.8-0.5-1.1c0.5-0.2,0.9-0.7,0.9-1.3c0-0.7-0.6-1.4-1.4-1.4l0,0c0.3-0.2,0.4-0.6,0.4-1c0-0.7-0.6-1.4-1.4-1.4L4.9,4
								C5.7,2.7,6.8,0.7,5.6,0.1z"/>
							</svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



<?= $this->render('footer'); ?>