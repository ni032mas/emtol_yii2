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
                <div class="col-sm-12">
                    <?php
                    $k = 0;
                    foreach ($freeObj as $obj) {
                        $k = $k++;
                        ?>
                        <div class="item-card">
                            <div class="col-sm-8">
                                <?php
                                $imgs = array();
                                foreach ($obj->getBehavior('galleryBehavior')->getImages() as $image) {
                                    $imgUrl = $image->getUrl('medium');
                                    if ($imgUrl == null) {
                                        $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
                                        Yii::info('Нет картинки');
                                    }
                                    $imgs[] = ['img' => $imgUrl];
                                }
                                echo \metalguardian\fotorama\Fotorama::widget(
                                    [
                                        'items' => $imgs,
                                        'options' => [
                                            'nav' => 'thumbs',
                                        ]
                                    ]
                                );
                                ?>

                            </div><!-- /.col-sm-8 -->
                            <div class="col-sm-4">
                                <h1>
                                    <a href="<?= Url::to(['/tour/view', 'id' => $obj->id, 'datebegin' => '']) ?>">
                                        <?= $obj->name ?>
                                    </a>
                                </h1>
                                <h2>Описание</h2>
                                <?= $obj->description ?>
                                <h2>Цена</h2>
                                <?php echo $obj->price ?>
                            </div><!-- /.col-sm-4 -->
                        </div><!-- /.item -->
                        <?php
                    }
                    ?>
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
        </div><!-- /.objreservation-content -->
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


