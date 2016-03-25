<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\NavBar;
use kartik\widgets\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'EMTOL - бронирование экскурсий';


?>

<?php
NavBar::begin();

?>
<div class="searchfreereservationinfo-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['SearchfreereservationinfoController/index'],
        'options' => [
            'class' => 'form-inline'
        ]]);
    ?>

    <?= $form->field($model, 'search_data')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => 'Введите ключевые слова...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>
    <?= $form->field($model, 'date_begin')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <div class="form-group btn-search">
        <?= Html::submitButton('Вперед!', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end();
    NavBar::end();
    ?>
    <!--<div class="site-index">

        <div class="jumbotron">
            <h1>Congratulations!</h1>

            <p class="lead">You have successfully created your Yii-powered application.</p>

            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        </div>

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                </div>
            </div>

        </div>
    </div>-->

</div>