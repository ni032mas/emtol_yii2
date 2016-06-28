<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\NavBar;
use yii\bootstrap\Carousel;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use evgeniyrru\yii2slick\Slick;

/* @var $this yii\web\View */

$this->title = 'EMTOL - бронирование экскурсий';
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false" data-pause="false">
    <div class="container">
        <div class="searchfreereservationinfo-form">
            <?php
            NavBar::begin();
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['searchfreereservationinfo/index'],
                'options' => [
                    'class' => 'form-inline'
                ]]);
            ?>
            <?= $form->field($model, 'search_data')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Введите ключевые слова...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>
            <?= $form->field($model, 'date_begin')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
            <div class="form-group btn-search">
                <?= Html::submitButton('Вперед!', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end();
            NavBar::end();
            ?>
        </div>
        <div class="container objreservation-content">
            <div class="row">
                <?php
                foreach ($freeObj as $obj) {
                    foreach ($obj->getBehavior('galleryBehavior')->getImages() as $image) {
                        $imgUrl = $image->getUrl('medium');
                        if ($imgUrl == null) {
                            $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
                            Yii::info('Нет картинки');
                        }
                        $itemsObj[] = [
                            'content' => Html::img($imgUrl),
                            'caption' => '',
                            'options' => []];
                    }
                    ?>
                    <div class="col-sm-4">
                        <h4>
                            <?= $obj->name ?>
                        </h4>
                        <?php
                        echo Carousel::widget([
                                'items' => $itemsObj,
                                'options' => [],
                            ]
                        );
                        ?>
                        <h6>
                            <?= $obj->description ?>
                        </h6>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <!-- /.objreservation-content -->
    </div>
    <?php
    $carouselOptions = ['style' => 'height: 700px;', 'class' => 'item-background-carousel'];
    $itemsCarousel = [
        ['content' => '<div style="background: url(' . Url::to('@web/images/slider/slider01.JPG') . ');background-repeat: no-repeat;background-size: cover; height: 100%;"></div>',
            'caption' => '',
            'options' => $carouselOptions
        ],
        ['content' => '<div style="background: url(' . Url::to('@web/images/slider/slider02.JPG') . ');background-repeat: no-repeat;background-size: cover; height: 100%;"></div>',
            'caption' => '',
            'options' => $carouselOptions
        ],
        ['content' => '<div style="background: url(' . Url::to('@web/images/slider/slider03.JPG') . ');background-repeat: no-repeat;background-size: cover; height: 100%;"></div>',
            'caption' => '',
            'options' => $carouselOptions
        ]
    ];
    echo Carousel::widget([
            'items' => $itemsCarousel,
            'options' => ['class' => 'carousel-background'],
        ]
    )
    ?>
</div>


