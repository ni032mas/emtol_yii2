<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjreservationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Экскурсии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objreservation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать экскурсию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
                'label' => 'Наименование',
                'format' => 'text', // Возможные варианты: raw, html
            ],
            [
                'attribute' => 'description',
                'label' => 'Описание',
                'format' => 'text', // Возможные варианты: raw, html
            ],
            [
                'attribute' => 'location_id',
                'label' => 'Место проведения',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getLocationName();
                }
            ],
            [
                'attribute' => 'customer_id',
                'label' => 'Исполнитель',
                'format' => 'text', // Возможные варианты: raw, html
                'content' => function ($data) {
                    return $data->getCustomerName();
                }
            ],
            [
                'label' => 'Доступные даты',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Перейти', $data->getUrlReservationInfo(), ['title' => 'Смелей вперед!', 'target' => '_blank']);
                }
            ],
            [
                'label' => 'Заказы',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('Перейти', $data->getUrlOrders(), ['title' => 'Смелей вперед!', 'target' => '_blank']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
