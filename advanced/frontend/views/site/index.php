<?php

use metalguardian\fotorama\Fotorama;
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
            'allowClear' => true,
        ],
    ])

    ?>

    <!-- /.search-data -->

    <?php
    $today = new DateTime();
    ?>
    <?= $form->field($model, 'date_begin')->widget(\dosamigos\datepicker\DatePicker::classname(), [
        'language' => 'ru',
        'clientOptions' => [
//            'calendarWeeks' => true,
//            'daysOfWeekDisabled' => [0, 6],
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'startDate' => 'today',
            'defaultViewDate' => 'today',
            'value' => $today,
        ],

    ]) ?>
    <div class="form-group btn-search">
        <?= Html::submitButton('Вперед!', ['class' => 'btn btn-success']) ?>
    </div>
    <?php
    ActiveForm::end();
    NavBar::end();
    ?>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php
        $k = 0;
        foreach ($freeObj as $obj) {
            $k = $k++;
            ?>
            <div class="col-sm-4">
                <div class="item-card">
                    <h2>
                        <a href="<?= Url::to(['/tour/view', 'id' => $obj->id, 'datebegin' => '']) ?>">
                            <?= $obj->objreservation->name ?>
                        </a>
                    </h2>
                    <?php
                    $imgs = array();
                    foreach ($obj->objreservation->getBehavior('galleryBehavior')->getImages() as $image) {
                        $imgUrl = $image->getUrl('medium');
                        if ($imgUrl == null) {
                            $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
                            Yii::info('Нет картинки');
                        }
                        $imgs[] = ['img' => $imgUrl];
                    }
                    echo Fotorama::widget(
                        [
                            'items' => $imgs,
                            'options' => [
                                'nav' => 'thumbs',
                            ]
                        ]
                    );
                    ?>
                    <h3><?= $obj->objreservation->description ?></h3>
                    <h2>Цена</h2>
                    <?php echo $obj->price ?>
                </div><!-- /.item -->
            </div><!-- /.col-sm-4 -->
            <?php
        }
        ?>
    </div><!-- /.col-sm-12 -->
</div><!-- /.row -->



