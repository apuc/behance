<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\cabinet\models\SearchBalance */
/* @var $dataProvider yii\data\ActiveDataProvider
 * @var $history object
 * @var $account object
 */
$title = (is_string($account)) ? $account : $account->display_name;
$this->title = Yii::t('balance', 'History'). " " . $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">
    <h1><?= Html::encode($this->title) ?></h1>
	<table class="table table-striped table-bordered">
		<thead>
			<th>№</th>
			<th><?=Yii::t('history', 'Name')?></th>
			<th><?=Yii::t('history', 'Description')?></th>
			<th><?=Yii::t('history', 'Accounts ID')?></th>
			<th><?=Yii::t('history', 'Dt Add')?></th>
		</thead>
		<tbody>
		<?php $i=0; foreach ($history as $item): $i++;?>
			<tr>
				<td><?=$i?><?=count($item)?></td>
				<td><?=$item->name?></td>
				<td><?=$item->description?></td>
				<td><?=$item->accounts_id?></td>
				<td><?=$item->dt_add?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
