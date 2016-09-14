<?php
/* @var $this yii\web\View */
use common\widgets\SearchPanel;
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
    <div class="col-sm-3">
        <?= SearchPanel::widget(['dateBegin' => $dateBegin]) ?>
    </div><!-- /.col-sm-3 -->

    <div class="col-sm-9">
        <?php Pjax::begin(); ?>
        <div class="row">
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
                               href="<?= '/tour/index?sort=desc&dateBegin=' . $dateBegin ?>">Убывание</a>
                        </li>
                        <li><a id="<?= $sort == 'asc' ? 'btn-asc-enable' : 'btn-asc' ?>"
                               href="<?= '/tour/index?sort=asc&dateBegin=' . $dateBegin ?>">Возрастание</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /.row -->
        <?php
        $js = <<<JS
        $('#btn-desc').on('click', function() {
            $.ajax({
                url: '/tour/index',
                data: {sort: 'desc'},
                success: function(res) {
                  console.log(res);
                },
                error: function() {
                  alert('Error')
                }
            });  
        });
        // $('#btn-asc').on('click', function() {
        //     $.ajax({
        //         url: '/searchfreereservationinfo/index',
        //         data: {sort: 'asc'},
        //         success: function(res) {
        //           console.log(res);
        //         },
        //         error: function() {
        //           alert('Error')
        //         }
        //     });  
        // });

JS;
        $this->registerJs($js);
        ?>
        <div class="row">
            <?php
            foreach ($models as $model) {
                ?>
                <div class="item-card">
                    <div class="col-sm-8">
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

                    </div><!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <h1>
                            <a href="<?= Url::to(['/tour/view', 'id' => $model->id, 'datebegin' => $dateBegin]) ?>">
                                <?= $model->name ?>
                            </a>
                        </h1>
                        <h2>Описание</h2>
                        <?= $model->description ?>
                        <h2>Цена</h2>
                        <?php echo $model->price ?>
                    </div><!-- /.col-sm-4 -->
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
    <?php

    //    debug($model);
    debug($dateBegin);
    ?>
</div><!-- /.reservationobj-free -->
