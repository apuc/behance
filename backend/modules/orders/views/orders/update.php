<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\orders\models\Orders
 * @var $cases array
 * @var $accounts array
 */

$this->title = Yii::t('orders', 'Update Orders: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('orders', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('orders', 'Update');
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'accounts' => $accounts, 'cases' => $cases,
    ]) ?>

</div>
