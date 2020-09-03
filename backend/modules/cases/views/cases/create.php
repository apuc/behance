<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cases\models\Cases */

$this->title = Yii::t('cases', 'Create Cases');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cases', 'Cases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
