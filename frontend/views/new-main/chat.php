<?php

use yii\helpers\Url;

?>
<div class="root">
	<header class="header-small-wrap">
        <div class="header__stars1 header__stars">
            <div class="stars"></div>
            <div class="stars2"></div>
            <div class="stars3"></div><img src="/images/chat/images/header-bg3.png" alt="">
        </div>
        <div class="header">
            <div class="container">
                <div class="header__menu">
                    <div class="header__left">
                        <a class="header__menu-btn" href="mailto:info@avtouzor.ru">
                            <span class="header__menu-btn-round">@</span>
                            <span class="header__menu-btn-text">
                              <span class="fz12 fw-extra-bold">info@betop.space</span>
                          </span>
                        </a>

<!--                        <div class="header__menu-btn">-->
<!--                            <div class="header__menu-btn-round">-->
<!--                                <i class="fa fa-phone"></i>-->
<!--                            </div>-->

<!--                            <div class="header__menu-btn-text">-->
<!--                                <a class="header__btn fz12 fw-extra-bold" href="tel:+8 812 319-36-02">+7 928 770 19 79</a>-->
<!--                                <button class="header__btn fz10 fw-medium js-backCall" type="button">Заказать обратный звонок</button>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <div class="header__right">
                        <nav class="header__nav">
                        </nav>

                        <a class="header__nav-item" href="/">Главная</a>
                        <a class="header__nav-item" href="/about">О сервисе</a>
                        <!--<a class="header__nav-item" href="/#tarif">Тарифы</a>-->
                        <!--<a class="header__nav-item" href="/#reviews">Отзывы</a>-->
                        <!--<a class="header__nav-item" href="#">Блог</a>-->

<!--                        <a href="/site/login" class="btn btn-pink">Вход</a>-->

                        <!--<a class="header__icon" href="?//= Url::toRoute(['/site/login']); ?">
                            <img src="/images/chat/images/icons/ico-enter-blue.png"/>
                        </a>

                        <a class="header__icon" href="?//= Url::toRoute(['/site/login']); ?">
                            <img src="/images/chat/images/icons/ico-user-blue.png"/>
                        </a>-->
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

            </div>
        </div>
    </header>

	<main>
		<section class="commentsBehance">
			<div class="commentsBehance_wrapper">
				<header>
					<h1>Получай комментарии
<span>к своим кейсам Behance</span>
                    </h1>
				</header>
				<p><span>Чат активности</span> - это группа людей, которые хотят развивать свои каналы, набирать лайки и получать комментарии.
В чате все происходит взаимно. Написал комментарий ты - написали тебе (кроме формата учатия Премиум).
				</p>
				<p><span>Вступай в Чат Активности и начни получать комментарии и лайки к своим постам!</span>
				</p>
				<div class="commentsBehance_wrapper_block">

					<aside class="asidePhone">
						<div class="asidePhone_wrapper">
							<img src="/images/chat/images/phone_border.png" alt="">
							<div class="asidePhone_slides">
								<img src="/images/chat/images/phone1.jpg" alt="">
							</div>
						</div>
					</aside>

					<div class="commentsBehance_wrapper_block_img">
						<img src="/images/chat/images/service-icon-1.png" alt="">
					</div>

					<div class="commentsBehance_wrapper_block_text">
						<header>
							<p>Только реальные люди. Никаких ботов. Заходи и выкладывай пост</p>
						</header>
						<p>Чат создан для того, чтобы малознакомые дизайнеры
						имели возможность развивать свои каналы и продвигать
						проекты, используя взаимную поддержку.</p>
					</div>

					<div class="commentsBehance_wrapper_block_button">
						<svg version="1.1"
							 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 51.198 51.199"
							 style="enable-background:new 0 0 51.198 51.199;" xml:space="preserve">
							<path d="M0.492,38.246H0.488c0,0.004-0.004,0.004-0.004,0.008c-0.137,0.156-0.238,0.343-0.32,0.543
								c-0.024,0.062-0.043,0.117-0.059,0.179c-0.047,0.153-0.078,0.313-0.086,0.477c-0.004,0.062-0.015,0.117-0.011,0.18
								C0.008,39.668,0,39.695,0,39.726c0.011,0.192,0.051,0.375,0.109,0.551c0.004,0.016,0.016,0.031,0.024,0.051
								c0.07,0.191,0.171,0.359,0.289,0.516c0.019,0.019,0.023,0.05,0.043,0.07l8.246,9.719c0.633,0.742,1.668,0.757,2.316,0.027
								c0.645-0.727,0.656-1.922,0.024-2.664l-4.446-5.242c6.496,0.863,12.883-0.504,13.188-0.575c19.715-3.57,33.668-21.781,31.101-40.585
								C50.769,0.66,50.074,0,49.281,0c-0.086,0-0.172,0.008-0.258,0.019c-0.89,0.164-1.5,1.129-1.363,2.157
								c2.285,16.753-10.445,33.027-28.43,36.289c-0.082,0.019-6.679,1.433-12.894,0.457l6.863-4.075c0.805-0.476,1.117-1.613,0.703-2.539
								c-0.41-0.929-1.398-1.289-2.203-0.816L0.883,37.914C0.738,38.004,0.605,38.117,0.492,38.246L0.492,38.246z"/>
						</svg>
						<p>Хочу участвовать сейчас!</p>
						<!--<button id="showContent">
							<p>Войти <span>в чат</span></p>
                            <div id="content" style="display:none;"><a class="footer__nav-item" href="#">Вконтакте</a><br><a class="footer__nav-item" href="#">Телеграм</a></div>
						</button>-->

                        <button id="myBtn">
                            <p>Войти <span>в чат</span></p>
                        </button>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close">&times;</span>
                                    <h2>Выберите социальную сеть</h2>
                                </div>
                                <div class="modal-body">
                                    <img src="/images/uploaded/vk.png" style="/home/oem/Загрузки/telegram.pngwidth: 75px;" alt="">
                                    <a class="footer__nav-item" href="https://vk.com/im?invite_chat_id=8589934592396905586&invite_hash=1zI5YfiaKPMTPw==">
                                    <button id="vk-butt">
                                        <p>Вконтакте <span></span></p>
                                    </button>
                                    </a>
                                    <br>
                                    <img src="/images/uploaded/telegram.png" style="width: 125px" alt="">
                                    <a class="footer__nav-item" href="#">
                                    <button id="telegram-butt" >
                                        <p>Телеграм <span></span></p>
                                    </button>
                                    </a>
                                </div>
                                <div class="modal-footer">
                                    <!--<h3>Мы ждем Вас</h3>-->
                                </div>
                            </div>

                        </div>
					</div>
				</div>
			</div>
		</section>


		<div class="main-background">
			<div class="callback-bg">
                <div class="stars-wrap callback-stars1">
                    <div class="stars"></div>
                    <div class="stars2"></div>
                    <div class="stars3"></div><img class="callback-comet1" src="/images/comet2.png" alt="">
                </div>
                <div class="stars-wrap callback-stars2">
                    <div class="stars"></div>
                    <div class="stars2"></div>
                    <div class="stars3"></div><img class="callback-comet2" src="/images/comet3.png" alt="">
                </div><img class="callback__img-bg" src="/images/chat/images/chat.png" alt="">
            </div>
		</div>

	</main>

	<footer class="footer-wrap">
        <div class="container">
            <div class="footer offset-xl-1">
                <div class="footer__nav">
                   <!-- <a class="footer__nav-item" href="/#tarif">Кейсы</a>-->
                    <!--<a class="footer__nav-item" href="#">Контакты</a>-->
                    <!--<a class="footer__nav-item" href="/site/about">Акции</a>-->
                    <!--<a class="footer__nav-item" href="/#reviews">Отзывы</a>-->
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
                        <span class="fz15 fw-extra-bold">info@betop.space</span>
                    </span>
                    </a>

<!--                    <a class="footer__btn">-->

<!--              <span class="footer__btn-text">-->
<!--                        </span></a><a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/14.png"></a>-->



<!--                    <a class="footer__btn">-->

<!--                        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>-->

<!--                        &lt;!&ndash;— VK Widget —&ndash;&gt;-->
<!--                        <div id="vk_community_messages" style="width: 50px; height: 50px; position: fixed; z-index: 10000; bottom: 0px; right: 20px; margin: 0px 0px 20px; background: none;"><iframe name="fXD6fc42" frameborder="0" src="https://vk.com/widget_community_messages.php?app=0&amp;width=300px&amp;_ver=1&amp;gid=174651711&amp;disable_welcome_screen=1&amp;ref_source_info=undefined&amp;ref_source_link=https%3A%2F%2Fbetop.space%2Fsite%2Fabout&amp;tooltip_text=%D0%95%D1%81%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%3F&amp;domain=betop.space&amp;button_position=undefined&amp;height=399&amp;url=https%3A%2F%2Fbetop.space%2Fsite%2Fabout&amp;referrer=https%3A%2F%2Fbetop.space%2F&amp;title=%D0%9E%20%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%B5&amp;16fd2b13174" width="50" height="50" scrolling="no" id="vkwidget1" style="overflow: hidden; box-shadow: none;"></iframe></div>-->
<!--                        <script type="text/javascript">-->
<!--                            VK.Widgets.CommunityMessages("vk_community_messages", 174651711, {expandTimeout: "10000",tooltipButtonText: "Есть вопрос?"});-->
<!--                        </script>-->

<!--                    </a>-->

                    <a class="footer__btn">

                        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

                        <!— VK Widget —>
                        <div id="vk_community_messages"></div>
                        <script type="text/javascript">
                            VK.Widgets.CommunityMessages("vk_community_messages", 174651711, {expandTimeout: "10000",tooltipButtonText: "Есть вопрос?"});
                        </script>

                    </a>


                </div>
            </div>
        </div>
    </footer>
</div>
