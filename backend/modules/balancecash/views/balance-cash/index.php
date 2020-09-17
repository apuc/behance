<?php

use common\models\Settings;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\balancecash\controllers\BalanceCashController */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Баланс наличных пользователей";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'Email',
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user['email'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'header' => 'Баланс, долл.',
                'attribute' => 'amount',
                'value' => function ($data) {
                    $exponent = intval(Settings::getSetting('balance_exponent'));
                    return $data['amount'] / $exponent;
                },
                'filter' => false,

            ],
            [
                'format' => 'raw',
                'value' => function ($data) {
                    return "<button type='button' class='btn btn-primary btn-balance-cash-grid' 
                               data-toggle='modal' data-id='{$data->user_id}'
                               data-target='#exampleModal'>Пополнить</button>";
                }
            ],
            [
                'format' => 'raw',
                'value' => function ($data) {
                    return "<button type='button' class='btn btn-danger btn-balance-withdraw-cash-grid' 
                               data-toggle='modal' data-id='{$data->user_id}'
                               data-target='#withdrawModal'>Снять</button>";
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Пополнить баланс пользователя</h3>
                </div>
                <div class="modal-body">
                    <form id="balance-cash-add-form">
                        <div class="form-group">
                            <labe>Добавить средств:</labe>
                            <input type="number" name="amount" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <span style="color: red" id="balance-cash-form-error"></span>
                            <input type="hidden" name="user_id" id="user-id-input">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="balance-cash-form-send">Пополнить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="withdrawModalLabel">Снять средства с баланса пользователя</h3>
                </div>
                <div class="modal-body">
                    <form id="balance-withdraw-cash-add-form">
                        <div class="form-group">
                            <labe>Снять средства:</labe>
                            <input type="number" name="amount" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <span style="color: red" id="balance-withdraw-cash-form-error"></span>
                            <input type="hidden" name="user_id_withdraw" id="user-id-withdraw-input">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="balance-withdraw-cash-form-send">Снять</button>
                </div>
            </div>
        </div>
    </div>

</div>

