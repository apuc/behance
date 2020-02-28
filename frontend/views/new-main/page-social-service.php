<?php

use common\models\PageSocials;
use common\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 * @var $seo Settings
 * @var $socials PageSocials[]
 * @var $service \common\models\PageSocialsServices
 */

$this->title = 'Betop.space';

//if($seo)
//{
//    $meta = json_decode($seo->value);
//
//    $this->registerMetaTag([
//        'name' => 'description',
//        'content' => $meta->descr
//    ]);
//
//    $this->registerMetaTag([
//        'name' => 'keywords',
//        'content' => $meta->keywords
//    ]);
//
//    $this->title = $meta->title;
//}

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
        <?= $this->render('contact'); ?>
    </main>



<?= $this->render('footer'); ?>