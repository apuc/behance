<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SupportQuestions */
/* @var $socials common\models\Social */

$this->title = 'Написать в тех. поддержку';
$this->params['breadcrumbs'][] = ['label' => 'Ответить', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        //'socials' => $socials,
    ]) ?>

</div>
