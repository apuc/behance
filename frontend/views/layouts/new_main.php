<?php

/* @var $this \yii\web\View */

/* @var $content string
 */

use common\models\PageSocials;
use frontend\assets\NewAppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\widgets\Alert;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
NewAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property=og:title content="<?php echo $this->title; ?>">
    <meta property=og:site_name content="behance.space">
    <meta property=og:type content="site">
    <meta property=og:url content="<?=Url::current([], true)?>">
    <meta property="og:description" content="Мы предлагаем быстрое продвижение вашего Behance аккаунта. Без ботов и блокировки.">
    <meta property="og:image" content="https://behance.space/images/og-image.png" />
    <meta property="og:image:secure_url" content="https://behance.space/images/og-image.png" />
    <meta property="og:image:type" content="image/png" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">

  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!— Global site tag (gtag.js) - Google Analytics —>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138968129-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-138968129-1');
    </script>

    <!— Yandex.Metrika counter —>
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(51223025, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            trackHash:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/51223025" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!— /Yandex.Metrika counter —>
</head>
<body>
<?php $this->beginBody() ?>

<div class="root">
    <?= $content ?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
