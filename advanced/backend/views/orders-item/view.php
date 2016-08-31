<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdersItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'reservationinfo_id',
            'price',
            'qty_item',
            'sum_item',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
