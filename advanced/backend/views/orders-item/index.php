<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Содержимое заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить в заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'order_id',
//            'reservationinfo_id',
            [
                'attribute' => 'reservationinfo_id',
                'label' => 'Экскурсия',
                'format' => 'text',
                'value' => function ($data) {
                    return $data->getObjreservationName();
                }
            ],
            'price',
            'qty_item',
            // 'sum_item',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
