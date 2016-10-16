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
                <div class="col-sm-12">
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
                </div><!-- /.col-sm-12 -->
                <div class="col-sm-12">
                    <h2>Описание</h2>
                    <?= $models[0]->objreservation->description ?>
                </div><!-- /.col-sm-12 -->
                <div class="col-sm-12">
                    <div class="col-sm-10">
                        <?php
                        $allowDates = [];
                        $allowTimes = [];
                        foreach ($models as $model) {
                            $allowDates[$model->id] = date('Y-m-d', $model->date_begin);
                            $allowTimes[$model->id] = date('H:i', $model->date_begin);
                        }
                        echo \vakorovin\datetimepicker\Datetimepicker::widget([
                            'name' => 'dosam',
                            'options' => [
                                'lang' => 'ru',
//                                'inline' => true,
                                'allowDates' => $allowDates,
                                'disabledDates' => ['2016-10-09'],
                                'allowTimes' => $allowTimes,
                                'format' => 'Y-m-d H:i',
//                                'onChangeDateTime' => 'function(dp, input){ alert(input) }',
                                'onChangeDateTime' => 'function(dp,$input){ getReservationinfoId(' . $models[0]->objreservation_id . ', $input.val()) }',
//                                'onSelectDate' => 'function(ct,$i){alert(ct.dateFormat(\'d/m/Y\'))}'
                            ]
                        ]);
                        echo QtyPanel::widget([
                            'qty' => 1,
                            'groupClass' => 'product product-qty',
                            'qtyMinusId' => 'qtyMinus',
                            'qtyPlusId' => 'qtyPlus',
                        ]);
                        ?>
                        <a class="btn btn-success add-to-cart">Купить</a>
                    </div><!-- /.col-sm-10 -->
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
