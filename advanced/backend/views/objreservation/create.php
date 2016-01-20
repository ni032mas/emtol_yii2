<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */

$this->title = 'Создать объект бронирования';
$this->params['breadcrumbs'][] = ['label' => 'Объекты бронирования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objreservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
