<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Reservationinfo */

$this->title = 'Добавить информацию о доступных датах и времени';
$this->params['breadcrumbs'][] = ['label' => 'Информация о доступных датах и времени', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
