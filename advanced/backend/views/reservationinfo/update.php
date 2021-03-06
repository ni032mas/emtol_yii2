<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Reservationinfo */

$this->title = 'Изменить доступные даты и время: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Информация о доступных датах и времени', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="reservationinfo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
