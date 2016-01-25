<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objreservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Введите название экскурсии')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Введите описание экскурсии')->label('Описание') ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->hint('Введите ключевые слова. Например, 33 водопада')->label('Ключевые слова') ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true])->dropDownList($model->getLocationList(), ['prompt' => 'Выберите место...']) ?>

    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true])->dropDownList($model->getCustomerList(), ['prompt' => 'Выберите исполнителя...']) ?>

    <?= $form->field($model, 'coordinate')->textInput(['maxlength' => true])->hint('Для получения координат поставьте точку на карте') ?>


    <?php
    /* echo '<label class="control-label">Место</label>';
      echo Typeahead::widget([

      'name' => 'location',
      'options' => ['placeholder' => 'Введите место'],
      'scrollable' => true,
      'pluginEvents' => [
      "typeahead:select" => 'function(ev, resp) { $(\'#objreservation-location_id\').val(resp.id); }',
      ],
      'dataset' => [
      [
      'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
      'display' => 'value',
      'prefetch' => Url::toRoute('locations/locationlist'),
      'remote' => [
      'url' => Url::toRoute('locations/locationlist') . '?q=%QUERY',
      'wildcard' => '%QUERY'
      ]
      ]
      ]
      ]); */
    $data = [
        "red" => "red",
        "green" => "green",
        "blue" => "blue",
        "orange" => "orange",
        "white" => "white",
        "black" => "black",
        "purple" => "purple",
        "cyan" => "cyan",
        "teal" => "teal"
    ];

// Tagging support Multiple
    echo '<label class="control-label">Tag Multiple</label>';
    echo Select2::widget([
        'name' => 'color_1',
        'value' => ['red', 'green'], // initial value
        'data' => $data,
        'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);
//    $form->field($model, 'keywords')->textInput(['maxlength' => true])->widget(Select2::classname(), [
//        'name' => 'color_1',
//        'value' => ['red', 'green'], // initial value
//        'data' => $data,
//        'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
//        'pluginOptions' => [
//            'tags' => true,
//            'maximumInputLength' => 10
//        ],
//    ]);
    ?>



    <?php
    echo Html::input('text', 'tagger', '', [
        'id' => 'tagger',
    ]);
    ?>

    <?php
    if ($model->isNewRecord) {
//        echo 'Can not upload images for new record';
    } else {
        echo GalleryManager::widget(
                [
                    'model' => $model,
                    'behaviorName' => 'galleryBehavior',
                    'apiRoute' => 'objreservation/galleryApi'
                ]
        );
    }
    ?>



    <div class="s2-event-log">
        <ul class="js-event-log"></ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div id="map" style="width: 600px; height: 400px"></div>

    <?php
//    $script = '
//        ymaps.ready(init);
//        var myMap, 
//            myPlacemark;
//        
//        function init() {
//            var myPlacemark,
//                myMap = new ymaps.Map(\'map\', {
//                    center: [55.753994, 37.622093],
//                    zoom: 9
//                }, {
//                    searchControlProvider: \'yandex#search\'
//            });
//
//            // Слушаем клик на карте
//            myMap.events.add(\'click\', function (e) {
//            var coords = e.get(\'coords\');
//
//            // Если метка уже создана – просто передвигаем ее
//            if (myPlacemark) {
//            myPlacemark.geometry.setCoordinates(coords);
//            }
//            // Если нет – создаем.
//            else {
//            myPlacemark = createPlacemark(coords);
//            myMap.geoObjects.add(myPlacemark);
//            // Слушаем событие окончания перетаскивания на метке.
//            myPlacemark.events.add(\'dragend\', function () {
//            getAddress(myPlacemark.geometry.getCoordinates());
//            });
//            }
//            getAddress(coords);
//            });
//
//            // Создание метки
//            function createPlacemark(coords) {
//            return new ymaps.Placemark(coords, {
//            iconContent: \'поиск...\'
//            }, {
//            preset: \'islands#violetStretchyIcon\',
//            draggable: true
//            });
//            }
//
//            // Определяем адрес по координатам (обратное геокодирование)
//            function getAddress(coords) {
//            myPlacemark.properties.set(\'iconContent\', \'поиск...\');
//            ymaps.geocode(coords).then(function (res) {
//            var firstGeoObject = res.geoObjects.get(0);
//
//            myPlacemark.properties
//            .set({
//            iconContent: firstGeoObject.properties.get(\'name\'),
//            balloonContent: firstGeoObject.properties.get(\'text\')
//            });
//            });
//        }
//    }';
//
//    $this->registerJs($script, yii\web\View::POS_END);
    ?>
</div>

