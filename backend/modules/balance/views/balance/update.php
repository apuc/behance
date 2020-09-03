<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\balance\models\Balance
 * @var $accounts array
 */

$this->title = 'Изменить баланс пользователя '.$model->user['email'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('balance', 'Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('balance', 'Update');
?>
<div class="balance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
