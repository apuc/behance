<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\prices\models\FormModel */

$this->title = 'Изменить цену '.$model->key;

?>
<div class="prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
