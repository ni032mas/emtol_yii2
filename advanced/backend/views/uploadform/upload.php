<?php

use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

<?= Yii::info(Yii::getAlias('@webroot') . '/images/product/gallery') ?>
<button>Submit</button>

<?php ActiveForm::end() ?>
