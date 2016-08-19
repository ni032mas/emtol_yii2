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
                        foreach ($models as $model) {
                            $itemsPrice[$model->id] = "Начало " . date('d-m-Y в H:m', $model->date_begin) . " - Цена " . $model->price . " руб.";
                        }
                        $form = ActiveForm::begin(
                            [
                                'action'=>'/searchfreereservationinfo/view?id=3',
                                'options' => ['class' => 'form-inline']
                            ]);
                        $params = [
                            'prompt' => 'Выберите дату и цену'
                        ];
                        echo $form->field($modelPrice, 'reservationId')->dropDownList($itemsPrice, $params);
                        echo $form->field($modelPrice, 'qty')->widget(QtyPanel::className());
                        ?>
                        <div class="form-group">
                            <?= Html::submitButton('Купить', ['class' => 'btn btn-success']) ?>
                        </div>
                        <!--                    <p class="er">ошибка</p>-->
                    </div><!-- /.col-sm-10 -->
                    <?php
                    ActiveForm::end();
                    ?>
                </div><!-- /.col-sm-12 -->
            </div><!-- /.item-card -->
        </div><!-- /.row -->
    </div><!-- /.col-sm-9 -->
    <?php
    //    debug($models);
    debug($itemsPrice);
    //    debug($dateBegin);
    ?>
</div><!-- /.container -->
