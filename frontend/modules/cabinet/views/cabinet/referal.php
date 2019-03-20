<?php
$this->title = 'Партнерская программа';
$link = "https://".$_SERVER['HTTP_HOST'].'/signup?ref='.Yii::$app->user->identity->ref_hash;
?>
<p class="ref-text">
    Это ваша уникальная реферальная ссылка. Вы можете отправить ее вашим друзьям и  получать
    <?=Yii::$app->params['referal_likes']?> лайков и <?=Yii::$app->params['referal_views']?> просмотров за каждую регистрацию по этой ссылке абсолютно бесплатно!
</p>
<p href="#" class="ref-link"><?=$link?></p>
