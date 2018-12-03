<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\CabinetAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Balance;



$balance = Balance::find()->where(['user_id'=>Yii::$app->user->getId()])->one();

CabinetAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-persistent-drawer mdc-persistent-drawer--open" style="height: 100%;">
        <nav class="mdc-persistent-drawer__drawer">
            <div class="mdc-persistent-drawer__toolbar-spacer">
                <?= Html::img('/images/account.png',['width'=>'32','height'=>'32']) ?>
                <span class="brand-logo">
                   <?= Yii::$app->user->identity->username; ?>
                </span>
            </div>
            <div class="mdc-list-group">
                <nav class="mdc-list mdc-drawer-menu">

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/']); ?>">
                            <i class="fa fa-home" style="visibility: visible;"></i>
                            <span>На гавную</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">


                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/accounts']); ?>">
                            <i class="fa fa-user" style="visibility: visible;"></i>
                            <span>Аккаунты</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/works']); ?>">
                            <i class="fa fa-suitcase" style="visibility: visible;"></i>
                            <span>Работы</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/queue']); ?>">
                            <i class="fa fa-heart" style="visibility: visible;"></i>
                            <span>Работы в лайкере</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/payment']); ?>">
                            <i class="fa fa-usd"></i>
                            <span>Пополнить баланс</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/history') ?>">
                            <i class="fa fa-history" style="visibility: visible;"></i>
                            <span>История пополнений</span>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/cabinet/referal') ?>">
                            <i class="fa fa-users"></i>
                            <span>Партнерская программа</span>
                        </a>
                    </div>


                    <!--                    					<div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="sample-page-submenu">-->
<!--                    						<a class="mdc-drawer-link" href="#">-->
<!--                    							<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>-->
<!--                    							Sample Pages-->
<!--                    							<i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>-->
<!--                    						</a>-->
<!---->
<!--                    						<div class="mdc-expansion-panel" id="sample-page-submenu">-->
<!--                    							<nav class="mdc-list mdc-drawer-submenu">-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/blank-page.html">-->
<!--                    										Blank Page-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/403.html">-->
<!--                    										403-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/404.html">-->
<!--                    										404-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/500.html">-->
<!--                    										500-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/505.html">-->
<!--                    										505-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/login.html">-->
<!--                    										Login-->
<!--                    									</a>-->
<!--                    								</div>-->
<!--                    								<div class="mdc-list-item mdc-drawer-item">-->
<!--                    									<a class="mdc-drawer-link" href="pages/samples/register.html">-->
<!--                    										Register-->
<!--                    									</a>-->
<!--                    								</div>-->
<!---->
<!--                    							</nav>-->
<!--                    						</div>-->
<!--                    					</div>-->

                </nav>
            </div>
        </nav>
    </aside>
    <!-- partial -->
    <!-- partial:partials/_navbar.html -->
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>


                <?php if(!empty($balance)): ?>
                    <div class="balance-block">
                        <span class="mdc-toolbar__menu-icon">Лайки:<span id="balance_likes"><?=$balance->likes; ?></span></span>
                    </div>

                    <div class="balance-block">
                        <span class="mdc-toolbar__menu-icon">Просмотры:<span id="balance_views"><?=$balance->views; ?></span></span>
                    </div>
                <?php  endif; ?>

            </section>
            <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
                <!--				<div class="mdc-menu-anchor">-->
                <!--					<a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="notification-menu" data-mdc-auto-init="MDCRipple">-->
                <!--						<i class="material-icons">notifications</i>-->
                <!--						<span class="dropdown-count">3</span>-->
                <!--					</a>-->
                <!--					<div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">-->
                <!--						<ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">email</i>-->
                <!--								One unread message-->
                <!--							</li>-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">group</i>-->
                <!--								One event coming up-->
                <!--							</li>-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">cake</i>-->
                <!--								It's Aleena's birthday!-->
                <!--							</li>-->
                <!--						</ul>-->
                <!--					</div>-->
                <!--				</div>-->



                <div class="mdc-menu-anchor mr-1">
                    <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                        <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">

                            <li class="mdc-list-item" role="menuitem" tabindex="0">

                                <a  style="text-decoration: none; font-size: 14px;" href="<?= Url::toRoute(['cabinet/logout']); ?>">
                                    <i class="material-icons mdc-theme--primary mr-1" style="font-size: 16px;">power_settings_new</i>
	                                Logout</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </header>
    <!-- partial -->
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
            <div style="padding: 0px 20px;">

                <?php if(Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong style="font-size: 15px;"><?= Yii::$app->session->getFlash('error'); ?></strong>
                </div>
                <?php endif; ?>

                <?php if(Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong style="font-size: 15px;"><?= Yii::$app->session->getFlash('success'); ?></strong>
                    </div>
                <?php endif; ?>

                <?= $content ?>
            </div>

        </main>




<footer>
	<div class="mdc-layout-grid">
		<div class="mdc-layout-grid__inner">
			<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">

			</div>
			<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex justify-content-end">

			</div>
		</div>
	</div>
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
