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


<div class="col-sm-3">
    <?= SearchPanel::widget(['dateBegin' => $dateBegin]) ?>
</div><!-- /.col-sm-3 -->
<div class="col-sm-9">
    <div class="row">
        <div class="item-card">
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
                                'nav' => 'thumbs',
                            ]
                        ]
                    );
                    ?>
                </div><!-- /.col-sm-7 -->
                <div class="col-sm-5">
                    <div class="item-card-btn-group">
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
                            ]
                        ]);
                        $i = 0;
                        $dateBegin = '';
                        $divOpenTimeEvent = false;
                        echo Html::beginTag('div', ['class' => 'row',]);
                        foreach ($models as $model) {
                            if ($dateBegin != Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d') && $divOpenTimeEvent) {
                                echo Html::endTag('div');
                            }
                            if ($dateBegin != Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d')) {
                                $divOpenTimeEvent = false;
                                echo Html::beginTag('div',
                                    [
                                        'class' => 'time-event',
                                        'data' => ['date' => Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d')]
                                    ]
                                );
                            }
                            echo Html::tag('div',
                                Html::tag('div',
                                    Html::encode(Yii::$app->formatter->asDatetime($model->date_begin, 'php:H:i')),
                                    [
                                        'class' => 'item-card-btn btn',
                                        'data' => ['id' => $model->id]
                                    ]
                                ),
                                [
                                    'class' => 'col-sm-4',
                                ]
                            );
                            $dateBegin = Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d');
                            $divOpenTimeEvent = true;
                        }
                        echo Html::endTag('div');
                        echo Html::endTag('div');
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                echo QtyPanel::widget([
                                    'qty' => 1,
                                    'groupClass' => 'product product-qty',
                                    'qtyMinusId' => 'qtyMinus',
                                    'qtyPlusId' => 'qtyPlus',
                                ]);
                                ?>
                            </div><!-- /.col-sm-6 -->
                            <div class="col-sm-6">
                                <a class="btn btn-success add-to-cart pull-right">Купить</a>
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item-card-btn-group -->
                </div><!-- /.col-sm-5 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <h2>Описание</h2>
                    <?= $models[0]->objreservation->description ?>
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
        </div><!-- /.item-card -->
    </div><!-- /.row -->
</div><!-- /.col-sm-9 -->
<?php
//    debug($models);
//    debug($itemsPrice);
//    debug($dateBegin);
?>

