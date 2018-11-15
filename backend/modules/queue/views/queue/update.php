<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\queue\models\Queue */

$this->title = 'Обновить работу в очереди';

?>
<div class="queue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
