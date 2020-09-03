<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\balance\controllers\BalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Баланс пользователей";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                    'attribute'=>'user_id',
                   'value'=>function($data){
                       return $data->user['email'];
                   },
                   'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute'=>'views',
                'filter'=>false,

            ],
            [
                'attribute'=>'likes',
                'filter'=>false,
            ],
            [
                    'format'=>'raw',
                    'value'=>function($data){
                       return "<button type='button' class='btn btn-primary btn-balance-grid' 
                               data-toggle='modal' data-id='{$data->user_id}'
                               data-target='#exampleModal'>Пополнить</button>";
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]); ?>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Пополнить баланс пользоваетеля</h3>
                </div>
                <div class="modal-body">
                    <form id="balance-add-form">
                        <div class="form-group">
                            <labe>Добавить лайков:</labe>
                            <input type="number" name="likes" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <labe>Добавить просмотров:</labe>
                            <input type="number" name="views" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <span style="color: red" id="balance-form-error"></span>
                            <input type="hidden" name="user_id" id="user-id-input">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="balance-form-send">Пополнить</button>
                </div>
            </div>
        </div>
    </div>

</div>

