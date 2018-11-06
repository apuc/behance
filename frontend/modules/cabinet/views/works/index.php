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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    	<p>-->
<!--    		--><?php //echo Html::a(Yii::t('frontend', 'Create Works'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    	</p>-->

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
                }
            ],
            //'behance_id',
            'name',
            [
               'attribute'=>'url',
               'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                  return Html::a('Ссылка',$data->url,['target'=>'_blank']);
                }
            ],
            'start_likes',
            'start_views'



            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
