<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пополнение баланса';
?>
<div class="payment-index">

    <div class="form-group">
        <label for="">Выберите тариф</label>
      <?= Html::dropDownList('case','',$cases,['class'=>'form-control','id'=>'cases-select']);?>
    </div>

    <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
        <input type="hidden" name="ik_co_id" value="5bf411773c1eaf624a8b4568" />
        <input type="hidden" name="ik_pm_no" value="ID_4233" />
        <input type="hidden" name="ik_am" value="<?= $defaultCase->price ?>" />
        <input type="hidden" name="ik_cur" value="RUB" />
        <input type="hidden" name="ik_desc" value="Пополнение баланса" />
        <input type="hidden" name="ik_exp" value="2018-11-28" />
        <input type="hidden" name="ik_x_userid" value="<?= Yii::$app->user->getId() ?>" />
        <input type="hidden" name="ik_x_caseid" value="<?= $defaultCase->id ?>" />
        <input type="submit" value="Оплатить" class="btn btn-pink">
    </form>

</div>
