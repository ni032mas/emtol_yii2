<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjreservationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объекты бронирования';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objreservation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать объект бронирования', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
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
            'content' => function($data) {
                return $data->getLocationName();
            }
            ],
            [
            'attribute' => 'customer_id',
            'label' => 'Исполнитель',
            'format' => 'text', // Возможные варианты: raw, html
            'content' => function($data) {
                return $data->getCustomerName();
            }
            ],
            // 'alias',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
