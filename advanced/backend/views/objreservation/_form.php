<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;
use yii\web\JsExpression;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objreservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Введите название экскурсии')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Введите описание экскурсии')->label('Описание') ?>

    
    
    <?php
    echo '<label class="control-label">Место</label>';
    echo Typeahead::widget([

        'name' => 'location',
        'options' => ['placeholder' => 'Введите место'],
        'scrollable' => true,
        'pluginEvents' => [
            "typeahead:select" => 'function(ev, resp) { $("#objreservation-location_id").val(resp.id); }',
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
    ]);
    ?>

    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?= $form->field($model, 'location_id')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'created_at')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'updated_at')->hiddenInput()->label('') ?>
   
    <?php ActiveForm::end(); ?>

</div>
