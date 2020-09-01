<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageSocials */

$this->title = 'Создать соц. сеть';
$this->params['breadcrumbs'][] = ['label' => 'Соц. сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-socials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
