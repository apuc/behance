<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\YoutubeQueue */

$this->title = 'Добавить видео';
$this->params['breadcrumbs'][] = ['label' => 'Youtube', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="youtube-queue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
