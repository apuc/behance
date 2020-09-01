<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vipipsocials\models\SocialsServices */

$this->title = "Обновить наш собственный заголовок";
?>
<div class="socials_services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>