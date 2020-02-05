<?php

use frontend\modules\cabinet\models\SocialQueueForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model SocialQueueForm */
/* @var $socials array */
/* @var $friends_options array */
/* @var $friends_prices array */
/* @var $errors string */
/* @var $coeff string */

$this->title = 'Создание задачи';
$this->params['breadcrumbs'][] = ['label' => 'Social Queue', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-works-create">

    <h1><?= Html::encode("Создание задачи накрутки") ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'socials' => $socials,
        'friends_options' => $friends_options,
        'friends_prices' => $friends_prices,
        'errors' => $errors,
        'coeff' => $coeff
    ]) ?>

</div>
