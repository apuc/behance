<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\works\models\Works */

$this->title = Yii::t('works', 'Create Works');
$this->params['breadcrumbs'][] = ['label' => Yii::t('works', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
