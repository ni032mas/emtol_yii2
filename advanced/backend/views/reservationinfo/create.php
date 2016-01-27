<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Reservationinfo */

$this->title = 'Create Reservationinfo';
$this->params['breadcrumbs'][] = ['label' => 'Reservationinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
