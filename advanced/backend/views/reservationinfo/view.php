<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Reservationinfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Информация о доступных датах и времени', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationinfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'objreservation_id',
                'label' => 'Экскурсия',
                'value' => $model->getObjreservationName(),
            ],
            [
                'attribute' => 'date_begin',
                'label' => 'Создано',
                'format' => ['date', 'dd-MM-Y HH:mm:ss'], // Доступные модификаторы - date:datetime:time
                'headerOptions' => ['width' => '200'],
            ],
            [
                'attribute' => 'date_end',
                'label' => 'Создано',
                'format' => ['date', 'dd-MM-Y HH:mm:ss'], // Доступные модификаторы - date:datetime:time
                'headerOptions' => ['width' => '200'],
            ],
            'amount',
            'price',
            [
                'attribute' => 'created_at',
                'label' => 'Создано',
                'format' => ['date', 'dd-MM-Y HH:mm:ss'], // Доступные модификаторы - date:datetime:time
                'headerOptions' => ['width' => '200'],
            ],
            // Вариант с явным указанием формата вывода даты/времени
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd-MM-Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
        ],
    ])
    ?>
    <?php
//    echo $date_begin;
    ?>

</div>
