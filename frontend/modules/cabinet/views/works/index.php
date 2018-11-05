<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$home = (Url::home(true));

?>
<?= $this->render('_works', [
	'searchModel' => $searchModel,
	'dataProvider' => $dataProvider
]) ?>