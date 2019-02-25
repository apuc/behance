<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\controllers\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('settings', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

   <div style="margin: 30px 0px">
       <?php $form = ActiveForm::begin(["action"=>"/admin/settings/settings/fill-proxy",'options' => array(
           'enctype' => 'multipart/form-data',
       ),]); ?>

       <div class="form-group">
           <?= Html::label("Загрузить адресса proxy серверов") ?>
           <?php echo Html::fileInput("ipfile",'',['required'=>'true'])?>
       </div>


       <div class="form-group">
           <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
       </div>

       <?php ActiveForm::end(); ?>
   </div>

    <p>
        <?= Html::a('загрузить через API','/admin/settings/settings/load-proxy-from-api',['class'=>'btn btn-success'])?>
    </p>

    <p>
        <?= Html::a(Yii::t('settings', 'Create Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
               'attribute'=>'key',
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'key',
                    'data' => $names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
              'attribute'=>'value',
                'filter'=>false,

            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'],
        ],
    ]); ?>
</div>
