<?php
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="col-ms-4">
    <div class="item-card-panel">
        <?php
        $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['searchfreereservationinfo/index'],
            'options' => [
                'class' => 'form-inline search-panel'
            ]]);
        ?>
        <?= $form->field($model, 'search_data',
            [
                'options' =>
                    [
                        'class' => 'search-panel-data form-group',
                    ]
            ]
        )->widget(Select2::classname(),
            [
                'data' => $data,
                'options' =>
                    [
                        'placeholder' => 'Введите ключевые слова...',
                    ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
        ?>
        <?php $model->date_begin = $dateBegin ?>
        <?= $form->field($model, 'date_begin')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

        <div class="slider-value">
            <p>Цена между</p>
            <b>€ 10</b> <input id="ex2" type="text" class="span2" value=""
                               data-slider-min="10"
                               data-slider-max="1000" data-slider-step="5"
                               data-slider-value="[250,450]"/> <b>€ 1000</b>
        </div>
        <div class="form-group btn-search-">
            <?= Html::submitButton('Вперед!', ['class' => 'btn btn-success']) ?>
        </div>
        <?php
        ActiveForm::end();
        ?>

    </div><!-- /.item-card-panel -->
</div><!-- /.col-ms-4 -->
