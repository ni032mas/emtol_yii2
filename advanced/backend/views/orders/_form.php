<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Экскурсия',
                'attribute' => 'objreservation_id',
                'value' => $model->getObjreservationName(),
            ],
            [
                'attribute' => 'consumer_id',
                'value' => $model->getConsumerName(),
            ],
            'reserved_amount',
            'paid',
            'comment:ntext',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
        ],
    ])
    ?>
    
    <?= $form->field($model, 'order_status_id')->dropDownList($model->getOrderStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
