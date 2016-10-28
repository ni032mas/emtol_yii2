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
<div class="container">

    <div class="col-sm-3">
        <?= SearchPanel::widget(['dateBegin' => $dateBegin]) ?>
    </div><!-- /.col-sm-3 -->
    <div class="col-sm-9">
        <div class="row">
            <div class="item-card">
                <div class="col-sm-8">
                    <h1>
                        <?= $models[0]->objreservation->name ?>
                    </h1>
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
                </div><!-- /.col-sm-8 -->
                <div class="col-sm-4">
                    <h2>Описание</h2>
                    <?= $models[0]->objreservation->description ?>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?php
                        $allowDates = [];
                        $allowTimes = [];
                        $allowDateTimes = [];
                        foreach ($models as $model) {
                            $allowDates[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d');
                            $allowTimes[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'H:i');
                            $allowDateTimes[$model->id] = Yii::$app->formatter->asDatetime($model->date_begin, 'Y-M-d hh:i');
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
                                'disabledDates' => ['2016-10-09'],
                                'allowTimes' => $allowTimes,
                                'format' => 'Y-m-d H:i',
                                'formatDate' => 'Y-m-d',
                                'onChangeDateTime' => 'function(dp,$input){ getReservationinfoId(' . $models[0]->objreservation_id . ', $input.val()) }',
                            ]
                        ]);
                        ?>
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-4">
                        <?php
                        echo QtyPanel::widget([
                            'qty' => 1,
                            'groupClass' => 'product product-qty',
                            'qtyMinusId' => 'qtyMinus',
                            'qtyPlusId' => 'qtyPlus',
                        ]);
                        ?>
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-2">
                        <a class="btn btn-success add-to-cart">Купить</a>
                    </div><!-- /.col-sm-2 -->
                </div><!-- /.col-sm-12 -->
            </div><!-- /.item-card -->
        </div><!-- /.row -->
    </div><!-- /.col-sm-9 -->
    <?php
    //    debug($models);
    //    debug($itemsPrice);
    //    debug($dateBegin);
    ?>
</div><!-- /.container -->
