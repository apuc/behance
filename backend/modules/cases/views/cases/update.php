<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cases\models\Cases */

$this->title = "Обновить тариф ".$model->name;
?>
<div class="cases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
