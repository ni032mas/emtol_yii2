<?php
/* @var $this yii\web\View */
use common\widgets\SearchPanel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;


//$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['/']];
$this->title = 'Экскурсии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationobj-free">
    <div class="row">
        <div class="col-sm-3"></div><!-- /.col-sm-3 -->
        <div class="col-sm-9">
            <div class="btn-group btn-group-sort" role="group" aria-label="...">
                <button type="button" class="btn btn-primary">Самые популярные</button>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        По отзывам
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Убывание</a></li>
                        <li><a href="#">Возрастание</a></li>
                    </ul>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        По цене
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a id="<?= $sort == 'desc' ? 'btn-desc-enable' : 'btn-desc' ?>"
                               href="<?= Url::to(['/tour', 'sort' => 'desc', 'dateBegin' => $dateBegin]) ?>">Убывание</a>
                        </li>
                        <li><a id="<?= $sort == 'asc' ? 'btn-asc-enable' : 'btn-asc' ?>"
                               href="<?= Url::to(['/tour', 'sort' => 'asc', 'dateBegin' => $dateBegin]) ?>">Возрастание</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /.col-sm-9 -->
        <div class="row">
            <div class="col-sm-3">
                <?= SearchPanel::widget(['dateBegin' => $dateBegin]) ?>
            </div><!-- /.col-sm-3 -->
            <div class="col-sm-9">
                <?php Pjax::begin(); ?>
                <div class="row">
                    <?php
                    foreach ($models as $model) {
                        ?>
                        <div class="item-card">
                            <div class="col-sm-7">
                                <?php
                                $imgs = array();
                                foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
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
                                <p>
                                    <a href="<?= Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]) ?>">
                                        <?= $model->name ?>
                                    </a>
                                </p>
                                <p>
                                    Продолжительность <?= $model->duration ?> часов
                                </p>
                                <p>Цена от</p>
                                <span>
                                <?php
                                $reservationinfos = ArrayHelper::toArray($model->reservationinfos);
                                ArrayHelper::multisort($reservationinfos, ['price'], [SORT_ASC,]);
                                echo $reservationinfos[0]['price'];
                                ?>
                                </span>
                            </div><!-- /.col-sm-5 -->
                        </div><!-- /.item -->
                        <?php
                    }
                    ?>
                </div><!-- /.row -->
                <div class="pag">
                    <?= LinkPager::widget(['pagination' => $pages,]) ?>
                </div><!-- /.pag -->
                <?php Pjax::end(); ?>.
            </div><!-- /.col-sm-9 -->
        </div><!-- /.row -->
    </div><!-- /.row -->

</div><!-- /.reservationobj-free -->
