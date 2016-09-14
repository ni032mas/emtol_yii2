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


$this->title = $model->objreservation->name;
$this->params['breadcrumbs'][] = ['label' => 'Экскурсии', 'url' => ['/tour/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <div class="col-sm-3">
        <?php
        $dateBegin = new DateTime();
        ?>
        <?= SearchPanel::widget(['dateBegin' => $dateBegin->format('Y-m-d')]) ?>
    </div><!-- /.col-sm-3 -->
    <div class="col-sm-9">
        <?php
        if ($model) :
            ?>
            <div class="row">
                <div class="item-card">
                    <div class="col-sm-12">
                        <h1>
                            <?= $model->objreservation->name . ' ' . date('Y-m-d', $model->date_begin) ?>
                        </h1>
                        <?php
                        $imgs = array();
                        foreach ($model->objreservation->getBehavior('galleryBehavior')->getImages() as $image) {
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
                        <?= $model->objreservation->description ?>
                    </div><!-- /.col-sm-12 -->
                    <div class="col-sm-12">
                        <div class="col-sm-10">
                            <?php
                            echo QtyPanel::widget([
                                'qty' => 1,
                                'groupClass' => 'product product-qty',
                                'qtyMinus' => 'qtyMinus',
                                'qtyPlus' => 'qtyPlus',
                            ]);
                            ?>
                            <a class="btn btn-success add-to-cart-item" data-id="<?= $model->id ?>">Купить</a>
                        </div><!-- /.col-sm-10 -->
                    </div><!-- /.col-sm-12 -->
                </div><!-- /.item-card -->
            </div><!-- /.row -->
            <?php
        endif;
        ?>
    </div><!-- /.col-sm-9 -->
    <?php
    //    debug($models);
    //    debug($itemsPrice);
    //    debug($dateBegin);
    ?>
</div><!-- /.container -->
