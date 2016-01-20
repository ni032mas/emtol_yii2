<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objreservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Введите название экскурсии')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Введите описание экскурсии')->label('Описание') ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true])->dropDownList(\backend\models\Objreservation::getLocationList()) ?>
    
    <?php   $dataset = ['Сочи', 'Адлер', 'Азов'];
            echo Typeahead::widget([
       
                'name' => 'country_1',
                'options' => ['placeholder' => 'Filter as you type ...'],
                'scrollable' => true,
                'pluginOptions' => ['highlight' => true],
                'dataset' => [
                    [
                        'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                        'display' => 'value',
                        'prefetch' => Url::to(['locations/locationlist']),
                        'remote' => [
                                'url' => Url::to(['locations/locationlist']) . '?q=%QUERY',
                                'wildcard' => '%QUERY'
                            ]
                        ]
                ]
            ]);

        echo Typeahead::widget([
            'name' => 'location1',
            'options' => ['placeholder' => 'Filter as you type ...'],
            'scrollable' => true,
            'pluginOptions' => ['highlight' => true],
            'dataset' => [
                [
                    'local' => $dataset,
                ]
            ]
        ])
    
    
    ?>

    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <div class="form-group">
    <?= Html::activeDropDownList($model, 'location_id', \backend\models\Objreservation::getLocationList())?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
