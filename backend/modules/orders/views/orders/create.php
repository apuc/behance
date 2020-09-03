<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\orders\models\Orders
 *@var $accounts array
 *@var $cases array
 */

$this->title = Yii::t('orders', 'Create Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('orders', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'accounts' => $accounts, 'cases' => $cases,
    ]) ?>

</div>
