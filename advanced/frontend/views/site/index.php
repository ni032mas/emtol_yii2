<?php

use metalguardian\fotorama\Fotorama;
use yii\helpers\ArrayHelper;
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
        $i = 1;
        $endTag = 0;
        foreach ($freeObj as $model) {
            if ($i == 1) {
                echo Html::beginTag('div', ['class' => 'row row-flex row-flex-wrap']);
                $endTag = 1;
            }
            echo Html::tag('div',
                Html::tag('div',
                    Html::tag('div',
                        Html::tag('div',
                            Html::tag('h2',
                                Html::a($model->name,
                                    Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]),
                                    []),
                                []) .
                            Html::img(getPhoto($model), ['class' => 'main-tour-image']),
                            ['class' => 'col-sm-12']),
                        ['class' => 'row']) .
                    Html::tag('div',
                        Html::tag('div',
                            Html::tag('div',
                                Html::tag('p',
                                    'Продолжительность ' . $model->duration . ' часов',
                                    ['class' => 'duration']) .
                                Html::tag('p',
                                    'Цена от ' . getPrice($model) . ' руб.',
                                    ['class' => 'duration']) .
                                Html::a('Подробнее',
                                    Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]),
                                    ['class' => 'btn btn-success bottom-preview']),
                                ['class' => 'flex-description-tour']),
                            ['class' => 'col-sm-12']),
                        ['class' => 'row']),
                    ['class' => 'item-card']),
                ['class' => 'col-sm-4']);
            if ($i == 3) {
                echo Html::endTag('div');
                $endTag = 2;
                $i = 0;
            }
            $i++;
        }
        if ($endTag == 1) {
            echo Html::tag('div', '', ['class' => 'col-sm-6']);
            echo Html::endTag('div');
        }
        ?>
    </div><!-- /.col-sm-12 -->
</div><!-- /.row -->

<?php
function getPhoto($model)
{
    $imgs = array();
    foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
        $imgUrl = $image->getUrl('medium');
        if ($imgUrl == null) {
            $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
        }
        $imgs[] = ['img' => $imgUrl];
    }
    return $imgs[0]['img'];
}

function getFotorama($model)
{
    $imgs = array();
    foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
        $imgUrl = $image->getUrl('medium');
        if ($imgUrl == null) {
            $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
        }
        $imgs[] = ['img' => $imgUrl];
    }
    return \metalguardian\fotorama\Fotorama::widget(
        [
            'items' => $imgs,
            'options' => [
                'nav' => 'thumbs',
            ]
        ]
    );
}

function getPrice($model)
{
    $reservationinfos = ArrayHelper::toArray($model->reservationinfos);
    ArrayHelper::multisort($reservationinfos, ['price'], [SORT_ASC,]);
    return $reservationinfos[0]['price'];
}

?>

