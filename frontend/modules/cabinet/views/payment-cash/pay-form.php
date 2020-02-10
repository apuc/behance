<?php

use common\models\Settings;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $default_sum string */
/* @var $default_usd string */
/* @var $order_id string */
/* @var $form_sign string */
/* @var $merchant_id string */
/* @var $exchange_rate string */

$this->title = 'Пополнение баланса';
$exponent = intval(Settings::getSetting('balance_exponent'));
?>
<script>
    var exponent = <?= $exponent ?>;
</script>
<div class="payment-index">

    <div class="form-group">
        <label for="sum">Введите сумму в рублях</label>
        <?= Html::input('string', 'sum', $default_sum, ['class' => 'form-control', 'id' => 'sum']) ?>
    </div>
    <div class="form-group" id="info_div">
        <h3 class='font-italic'>Курс - 1&#36; = <span id="exchange_text"><?= $exchange_rate ?></span> руб.; к зачислению - <span id="usd_text"><?= $default_usd ?></span>&#36;</h3>
    </div>
    <div class="alert alert-danger display-error" id="error_div" style="display: none"></div>
    <div class="alert alert-success display-success" id="success_div" style="display: none"></div>

    <form method='get' action='https://www.free-kassa.ru/merchant/cash.php'>
        <input type='hidden' name='m' value='<?= $merchant_id ?>'>
        <input type='hidden' name='oa' id="pay-sum" value='<?= $default_sum.'.00' ?>'>
        <input type='hidden' name='o' id="pay-order-id" value='<?= $order_id ?>'>
        <input type='hidden' name='s' id="pay-sign" value='<?= $form_sign ?>'>
        <input type='hidden' name='us_userid' value='<?= Yii::$app->user->getId() ?>'>
        <input type='hidden' name='us_usd' id="pay-usd" value='<?= $default_usd ?>'>
        <input type="submit" id="submit-fc" value="Оплатить" class="btn btn-pink">
    </form>

</div>
