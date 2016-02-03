<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Экскурсия',
                'attribute' => 'objreservation_id',
                'value' => $model->getObjreservationName(),
            ],
            [
                'attribute' => 'reservationinfo_id',
                'value' => $model->getReservationinfoDate(),
            ],
            [
                'attribute' => 'consumer_id',
                'value' => $model->getConsumerName(),
            ],
            'reserved_amount',
            'paid',
            'comment:ntext',
            [
                'attribute' => 'order_status_id',
                'value' => $model->getOrderStatusName(),
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
        ],
    ])
    ?>

</div>
