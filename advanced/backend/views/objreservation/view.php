<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Объекты бронирования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objreservation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'name',
            'description:ntext',
            [
                'attribute' => 'location_id',
                'value' => $model->getLocationName(),
            ],
            [
                'attribute' => 'customer_id',
                'value' => $model->getCustomerName(),
            ],
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
    ]);

//    if ($model->isNewRecord) {
//        echo 'Can not upload images for new record';
//    } else {
//        echo GalleryManager::widget(
//                [
//                    'model' => $model,
//                    'behaviorName' => 'galleryBehavior',
//                    'apiRoute' => 'objreservation/galleryApi'
//                ]
//        );
//    }
//
    foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
        echo Html::img($image->getUrl('medium'));
    }
    ?>

    <?php
//    echo Carousel::widget([
//        'items' => [
//            // the item contains only the image
//            '<img src="http://topmira.com/images/1/Dogs/%D0%90%D0%B2%D1%81%D1%82%D1%80%D0%B0%D0%BB%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9%20%D1%88%D0%B5%D0%BB%D0%BA%D0%BE%D0%B2%D0%B8%D1%81%D1%82%D1%8B%D0%B9%20%D1%82%D0%B5%D1%80%D1%8C%D0%B5%D1%80.jpg"/>',
//            // equivalent to the above
//            ['content' => '<img src="http://topmira.com/images/1/Dogs/%D0%91%D1%80%D1%8E%D1%81%D1%81%D0%B5%D0%BB%D1%8C%D1%81%D0%BA%D0%B8%D0%B9%20%D0%B3%D1%80%D0%B8%D1%84%D1%84%D0%BE%D0%BD.jpg"/>'],
//            // the item contains both the image and the caption
//            [
//                'content' => '<img src="http://topmira.com/images/1/Dogs/%D0%BF%D0%B5%D0%BA%D0%B8%D0%BD%D0%B5%D1%81.jpg"/>',
//                'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
//                'options' => [],
//            ],
//        ]
//    ]);
    ?>

</div>
