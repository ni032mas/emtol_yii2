<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'objreservation_id',
                'label' => 'Экскурсия',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getObjreservationName();
                }
            ],
            [
                'attribute' => 'reservationinfo_id',
                'label' => 'Дата начала',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getReservationinfoDate();
                }
            ],
            [
                'attribute' => 'consumer_id',
                'label' => 'Заказчик',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getConsumerName();
                }
            ],
            [
                'attribute' => 'reserved_amount',
                'label' => 'Количество мест',
                'format' => 'text', // Возможные варианты: raw, html
            ],
            [
                'attribute' => 'comment',
                'label' => 'Комментарий к заказу',
                'format' => 'text', // Возможные варианты: raw, html
            ],
            [
                'attribute' => 'paid',
                'label' => 'Оплачено',
                'format' => 'text', // Возможные варианты: raw, html
            ],
            [
                'label' => 'Информация о дате',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Перейти', $data->getUrlReservationInfo(), ['title' => 'Смелей вперед!', 'target' => '_blank']);
                }
            ],
            [
                'label' => 'Ссылка на экскурсию',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Перейти', $data->getUrlObjreservation(), ['title' => 'Смелей вперед!', 'target' => '_blank']);
                }
            ],
            [
                'attribute' => 'order_status_id',
                'label' => 'Статус',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getOrderStatusName();
                },
                'value' => function ($model, $key, $index, $column) {
                    return Html::activeDropDownList($model, 'order_status_id', ArrayHelper::map(backend\models\OrdersStatus::find()->all(), 'id', 'name'));
                },
                'filter' => backend\models\Orders::getOrderStatusList()
            ],
            // 'comment:ntext',
            // 'created_at',
            // 'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]);
    ?>

</div>
