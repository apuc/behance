<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Settings */

$this->title = 'Добавить настройки SEO для страницы';

?>
<div class="settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'create'=>true
    ]) ?>

</div>
