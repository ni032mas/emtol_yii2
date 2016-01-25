<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */

$this->title = 'Редактировать объект бронирования: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Объекты бронирования', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="objreservation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
