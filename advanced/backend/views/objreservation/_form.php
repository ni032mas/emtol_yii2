<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Objreservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objreservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Введите название экскурсии')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Введите описание экскурсии')->label('Описание') ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true])->dropDownList(\backend\models\Objreservation::getLocationList()) ?>

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
