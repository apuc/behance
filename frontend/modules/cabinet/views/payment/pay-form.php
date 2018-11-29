<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пополнение баланса';
?>
<div class="payment-index">

    <div class="fotm-group">
        <a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/23.png"></a>
    </div>

    <div class="form-group">
        <label for="">Выберите тариф</label>
      <?= Html::dropDownList('case','',$cases,['class'=>'form-control','id'=>'cases-select']);?>
    </div>

    <form method='get' action='http://www.free-kassa.ru/merchant/cash.php'>
        <input type='hidden' name='m' value='<?= $merchant_id ?>'>
        <input type='hidden' name='oa' id="pay-sum" value='<?= $defaultCase->price ?>'>
        <input type='hidden' name='o' id="pay-order-id" value='<?= $order_id?>'>
        <input type='hidden' name='s' id="pay-sign" value='<?= $form_sign ?>'>
        <input type='hidden' name='us_userid' value='<?= Yii::$app->user->getId() ?>'>
        <input type='hidden' name='us_caseid' id="pay-case-id" value='<?= $defaultCase->id ?>'>
        <input type="submit" value="Оплатить" class="btn btn-pink">
    </form>

</div>
