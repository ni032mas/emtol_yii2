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

    <?= $form->field($model, 'objreservationId')->dropDownList($model->getObjreservationList(), ['prompt' => 'Выберите экскурсию...']) ?>

    <?=
    $form->field($model, 'dateBegin')->widget(Datetimepicker::className(), [
        'options' => [
            'lang' => 'ru',
            'format' => 'd-m-Y H:m'
        ]
    ])
    ?>

    <?=
    $form->field($model, 'dateEnd')->widget(Datetimepicker::className(), [
        'options' => [
            'lang' => 'ru',
            'format' => 'd-m-Y H:m'
        ]
    ])
    ?>
    <div class="weekdays">
        <?= $form->field($model, 'monday')->checkbox() ?>
        <?= $form->field($model, 'tuesday')->checkbox() ?>
        <?= $form->field($model, 'wednesday')->checkbox() ?>
        <?= $form->field($model, 'thursday')->checkbox() ?>
        <?= $form->field($model, 'friday')->checkbox() ?>
        <?= $form->field($model, 'saturday')->checkbox() ?>
        <?= $form->field($model, 'sunday')->checkbox() ?>
    </div><!-- /.weekdays -->
    <?= $form->field($model, 'hour')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
