<?php
/* @var $this yii\web\View */
use common\widgets\QtyPanel;
use common\widgets\SearchPanel;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = $models[0]->objreservation->name;
$this->params['breadcrumbs'][] = ['label' => 'Экскурсии', 'url' => ['/tour/']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-sm-3" xmlns="http://www.w3.org/1999/html">
    <?= SearchPanel::widget(['dateBegin' => $dateBegin]) ?>
</div><!-- /.col-sm-3 -->
<div class="col-sm-9">
    <div class="item-card">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <h1>
                        <?= $models[0]->objreservation->name ?>
                    </h1>
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-7">
                    <?php
                    $imgs = array();
                    foreach ($models[0]->objreservation->getBehavior('galleryBehavior')->getImages() as $image) {
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
//                                'data-width' => '100%',
//                                'data-ratio' => '800/600',
                                'nav' => 'thumbs',
                            ]
                        ]
                    );
                    ?>
                </div><!-- /.col-sm-7 -->
                <div class="col-sm-5">
                    <p>
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <span>Групповая экскурсия</span>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon glyphicon-ok"
                              aria-hidden="true"></span>
                        <span>Продолжительность 5 часов</span>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <span>Телефон поддержки 8 800 777 777 77</span>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <span>Гарантия возврата</span>
                    </p>
                    <a class="btn btn-success btn-scroll" href="#buy-card">Записаться</a>
                </div><!-- /.col-sm-5 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="tour-description">
                        <span><?= $models[0]->objreservation->description ?></span>
                    </div><!-- /.tour-description -->
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div id='buy-card' class="item-card-btn-group">
                        <div class="col-sm-12">
                            <div class="calendar-center">
                                <?php
                                $allowDates = [];
                                $allowTimes = [];
                                $allowDateTimes = [];
                                $arrTimeDate = [];
                                foreach ($models as $model) {
                                    $allowDates[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d');
                                    $allowTimes[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'php:H:i');
                                    $allowDateTimes[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'php:Y-m-d H:i');
                                    $arrTimeDate[Yii::$app->formatter->asDatetime($model->date_begin, 'php:Y-m-d H:i')] = Yii::$app->formatter->asDatetime($model->date_begin, 'php:H:i');
                                }

                                echo \vakorovin\datetimepicker\Datetimepicker::widget([
                                    'name' => 'dosam',
                                    'id' => 'dateBeginPicker',
                                    'options' => [
                                        'value' => Yii::$app->formatter->asDatetime($models[0]->date_begin, 'php:Y-m-d H:i'),
                                        'lang' => 'ru',
                                        'inline' => true,
                                        'allowDates' => $allowDates,
                                        'reservationinfoid' => '',
                                        'allowDateTimes' => $allowDateTimes,
                                        'timeDate' => $arrTimeDate,
                                        'disabledDates' => ['2016-10-09'],
                                        'allowTimes' => $allowTimes,
                                        'format' => 'Y-m-d H:i',
                                        'timepicker' => false,
                                        'formatDate' => 'Y-m-d',
//                                'onChangeDateTime' => 'function(dp,$input){ getReservationinfoId(' . $models[0]->objreservation_id . ', $input.val()) }',
                                        'onSelectDate' => 'function(ct,$i){ setTime(ct, $i.val()) }',
                                        'onChangeMonth' => 'function(ct,$i){ clearTime() }',
                                        'onChangeYear' => 'function(ct,$i){ clearTime() }',
                                    ]
                                ]);
                                ?>
                            </div><!-- /.calendar-center -->
                        </div><!-- /.col-sm-12 -->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                //                        Формируем кнопки с временем
                                $i = 0;
                                $endTag = 0;
                                $dateBegin = '';
                                $divOpenTimeEvent = false;
                                echo Html::beginTag('div', ['class' => 'row',]);
                                echo Html::tag('div', '', ['class' => 'col-sm-3']);
                                echo Html::beginTag('div', ['class' => 'col-sm-6',]);
                                foreach ($models as $model) {
                                    if ($dateBegin != Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d') && $divOpenTimeEvent) {
                                        echo Html::endTag('div');
                                    }
                                    if ($dateBegin != Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d')) {
                                        $i = 0;
                                        $divOpenTimeEvent = false;
                                        echo Html::beginTag('div',
                                            [
                                                'class' => 'time-event',
                                                'data' => ['date' => Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d')]
                                            ]
                                        );
                                    }
                                    $i++;
                                    echo Html::tag('div',
                                        Html::tag('div',
                                            Html::encode(Yii::$app->formatter->asDatetime($model->date_begin, 'php:H:i')),
                                            [
                                                'class' => 'item-card-btn btn',
                                                'data' => ['id' => $model->id]
                                            ]
                                        ),
                                        [
                                            'class' => 'col-sm-6',
                                        ]
                                    );
                                    if ($i % 2 == 0) {
                                        $i = 0;
                                        echo Html::tag('div', '', ['class' => 'clearfix',]);
                                    }
                                    $dateBegin = Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d');
                                    $divOpenTimeEvent = true;
                                }
                                echo Html::endTag('div');
                                echo Html::endTag('div');
                                echo Html::tag('div', '', ['class' => 'col-sm-3']);
                                echo Html::endTag('div');
                                ?>
                            </div><!-- /.col-sm-12 -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-sm-3"></div><!-- /.col-sm-3 -->
                            <div class="col-sm-2">
                                <?php
                                echo QtyPanel::widget([
                                    'qty' => 1,
                                    'groupClass' => 'product product-qty',
                                    'qtyMinusId' => 'qtyMinus',
                                    'qtyPlusId' => 'qtyPlus',
                                ]);
                                ?>
                            </div><!-- /.col-sm-2 -->
                            <div class="col-sm-2"></div><!-- /.col-sm-1 -->
                            <div class="col-sm-2"><a class="btn btn-success add-to-cart pull-right">Купить</a></div>
                            <!-- /.col-sm-2 -->
                            <div class="col-sm-3"></div><!-- /.col-sm-3 -->
                            <!-- /.col-sm-4 -->
                        </div><!-- /.row -->
                    </div><!-- /.item-card-btn-group -->
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
        </div><!-- /.col-sm-12 -->
    </div><!-- /.item-card -->
</div><!-- /.col-sm-9 -->
<?php
//    debug($models);
//    debug($itemsPrice);
//    debug($dateBegin);
?>


