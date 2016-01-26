<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use zxbodya\yii2\galleryManager\GalleryManager;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objreservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Введите название экскурсии')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Введите описание экскурсии')->label('Описание') ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true])->dropDownList($model->getLocationList(), ['prompt' => 'Выберите место...']) ?>

    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true])->dropDownList($model->getCustomerList(), ['prompt' => 'Выберите исполнителя...']) ?>
    
    <?=
    $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
        // calls an action that returns a JSON object with matched
        // tags
        'loadUrl' => ['tag/list'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'name',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => true,
        ],
    ])->hint('Use commas to separate tags')
    ?>

    <?= $form->field($model, 'coordinate')->textInput(['maxlength' => true])->hint('Для получения координат поставьте точку на карте') ?>





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


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div id="map" style="width: 600px; height: 400px"></div>

</div>


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
    ?>