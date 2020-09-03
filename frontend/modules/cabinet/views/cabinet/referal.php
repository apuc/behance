<?php
$this->title = 'Партнерская программа';
$link = "https://" . $_SERVER['HTTP_HOST'] . '/signup?ref=' . Yii::$app->user->identity->ref_hash;

use common\models\Settings; ?>
<p class="ref-text">
    Это ваша уникальная реферальная ссылка. Вы можете отправить ее вашим друзьям и получать
    <?= Settings::getSetting('referal_likes') ?> лайков и <?= Settings::getSetting('referal_views') ?> просмотров за
    каждую регистрацию по этой ссылке абсолютно бесплатно!
</p>
<p href="#" class="ref-link"><?= $link ?></p>
