<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 05.11.2018
 * Time: 10:52
 */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\works\controllers\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Работы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
              'attribute'=>'img',
              'label'=>'Картинка',
              'format'=>'raw',
              'value'=>function($data){
                return Html::img($data->image,['width'=>'200','height'=>'150']);
              }
            ],
            [
                'attribute'=>'account_id',
                'value'=>function($data){
                    return $data->account['display_name'];
                },
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'account_id',
                    'data' => $account_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            //'behance_id',
            [
                'attribute'=>'name',
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'name',
                    'data' => $works_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
               'attribute'=>'url',
               'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                  return Html::a('Ссылка',$data->url,['target'=>'_blank']);
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($data){
                    return "<button type='button' class='btn btn-pink btn-works-grid' 
                               data-toggle='modal' data-id='{$data->id}'
                               data-target='#exampleModal'>Добавить в лайкер</button>";
                }
            ],


            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]);


    ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Назначить лайки и просмотры работе</h3>
                </div>
                <div class="modal-body">
                    <form id="works-grid-form">
                        <div class="form-group">
                            <labe>Добавить лайков:</labe>
                            <input type="number" name="likes_work" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <labe>Добавить просмотров:</labe>
                            <input type="number" name="views_work" id="form-likes" class="form-control" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <span style="color: red" id="works-form-error"></span>
                            <input type="hidden" name="work_id" id="work-id-input" id="form-views">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="works-form-send">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

</div>

