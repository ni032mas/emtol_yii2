<?php
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="product product-qty btn-group input-group">
        <span class="input-group-btn qtyMinus">
            <button id="qtyMinus" class="btn btn-primary qtyMinus" type="button">
                -
            </button>
        </span>
    <?php
    echo Html::activeInput("text", $model, $attribute, [
        'id' => 'qtyField',
        'class' => 'input form-control input-text qty',
        'type' => 'search',
        'data-placeholder' => '0',
        'value' => '1',
        'name' => 'keyword',
    ]);
    ?>
<!--    <input name="keyword" type="search" class="input form-control input-text qty" id="qtyField" data-placeholder="0">-->
        <span class="input-group-btn qtyPlus">
            <button id="qtyPlus" class="btn btn-primary qtyPlus" type="button">
                +
            </button>
        </span>
</div>
