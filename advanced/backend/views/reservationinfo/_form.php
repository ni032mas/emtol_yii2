<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vakorovin\datetimepicker\Datetimepicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Reservationinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservationinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'objreservation_id')->dropDownList($model->getObjreservationList(), ['prompt' => 'Выберите экскурсию...']) ?>

    <?=
    $form->field($model, 'date_begin')->widget(Datetimepicker::className(), [
        'options' => [
            'lang' => 'ru',
        ]
    ])
    ?>

    <?=
    $form->field($model, 'date_end')->widget(Datetimepicker::className(), [
        'options' => [
            'lang' => 'ru',
        ]
    ])
    ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
