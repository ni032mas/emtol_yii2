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
                        $count = 1;
                        foreach ($models as $model) :
                            if ($count % 2 == 0) {
                                echo Html::beginTag('div', ['class' => 'item-card col-sm-6']);
                            }
                            echo Html::tag('div',
                                Html::tag('div',
                                    Html::tag('div',
                                        Html::tag('h2',
                                            Html::a($model->name,
                                                Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]),
                                                []),
                                            []) . getFotorama($model),
                                        ['class' => 'col-sm-12']),
                                    ['class' => 'row']) .
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
                                        ['class' => 'col-sm-12']),
                                    ['class' => 'row']),
                                ['class' => 'item-card col-sm-6']);
                            ?>
                            <div class="item-card col-sm-6">
                                <div class="col-sm-12">
                                    <h2>
                                        <a href="<?= Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]) ?>">
                                            <?= $model->name ?>
                                        </a>
                                    </h2>
                                    <?php
                                    $imgs = array();
                                    foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
                                        $imgUrl = $image->getUrl('medium');
                                        if ($imgUrl == null) {
                                            $imgUrl = Yii::getAlias('@web') . '/images/nophoto/nophoto_sea.jpg';
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
                                <div class="col-sm-12">
                                    <p class="duration">
                                        Продолжительность <?= $model->duration ?> часов
                                    </p>
                                    <p class="duration">Цена от
                                        <?php
                                        $reservationinfos = ArrayHelper::toArray($model->reservationinfos);
                                        ArrayHelper::multisort($reservationinfos, ['price'], [SORT_ASC,]);
                                        echo $reservationinfos[0]['price'];
                                        ?>
                                        руб. </p>
                                    <div class="bottom mobile-hidden">
                                        <button class="btn btn-success bottom-preview" type="submit"> Подробнее</button>
                                    </div>
                                </div><!-- /.col-sm-5 -->
                            </div><!-- /.item -->
                            <?php
                            $count++;
                        endforeach;
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
<?php
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