<?php

$link = "http://".$_SERVER['HTTP_HOST'].'/site/signup?ref='.Yii::$app->user->identity->ref_hash;
?>
<p class="ref-text">
    Это ваша уникальная реферальная ссылка. Вы можете отправить ее вашим друзьям и  получать
    100 лайков за каждую регистрацию по этой ссылке абсолютно бесплатно!
</p>
<p href="#" class="ref-link"><?=$link?></p>
