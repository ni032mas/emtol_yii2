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
$this->params['fluid'] = true;
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false" data-pause="false">
    <div class="container">
        <div class="tour-form">
            <?php
            NavBar::begin();
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/tour/index'],
                'options' => [
                    'class' => 'form-inline'
                ]]);
            ?>

            <?= $form->field($model, 'search_data', [
                'options' => [
                    'class' => 'search-data form-group',
                ]])->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Введите ключевые слова...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>

            <!-- /.search-data -->
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
            <div class="slider-value">
                Filter by price interval: <b>€ 10</b> <input id="ex2" type="text" class="span2" value=""
                                                             data-slider-min="10"
                                                             data-slider-max="1000" data-slider-step="5"
                                                             data-slider-value="[250,450]"/> <b>€ 1000</b>
            </div>
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
                            <?php
                            echo Html::a($obj->name, Yii::getAlias('@web') . 'site/select-obj?id=' . $obj->id);
                            ?>
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


