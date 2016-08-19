<?php

use yii\helpers\Html;
use yii\grid\GridView;
use vakorovin\datetimepicker\Datetimepicker;

//use yii\jui\DatePicker;
//use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReservationinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Информация о доступных датах и времени';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'content' => function($data) {
                    return $data->getObjreservationName();
                },
            ],
            [
                'attribute' => 'date_begin',
                'value' => 'date_begin',
                'format' => ['date', 'Y/MM/dd HH:mm'], // Возможные варианты: raw, html
                'filter' => DateTimePicker::widget([
                    'attribute' => 'date_begin',
                    'model' => $searchModel,
                    'options' => [
                        'lang' => 'ru',
                    ]
                ]),
            ],
            [
                'attribute' => 'date_end',
                'value' => 'date_end',
                'format' => ['date', 'Y/MM/dd HH:mm'], // Возможные варианты: raw, html
                'filter' => DateTimePicker::widget([
                    'attribute' => 'date_end',
                    'model' => $searchModel,
                    'options' => [
                        'lang' => 'ru',
                    ]
                ]),
            ],
            'amount',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
