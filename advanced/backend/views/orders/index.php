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

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'consumer_id',
                'label' => 'Заказчик',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getConsumerName();
                }
            ],
            'qty',
            'sum',
            'paid',
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
            'comment:ntext',
            [
                'attribute' => 'created_at',
                'label' => 'Создано',
                'format' => ['date', 'dd/MM/Y HH:mm:ss'], // Доступные модификаторы - date:datetime:time
                'headerOptions' => ['width' => '200'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd/MM/Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
            [
                'label' => 'Содержимое',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Перейти', $data->getUrlReservationInfo(), ['title' => 'Смелей вперед!', 'target' => '_blank']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
