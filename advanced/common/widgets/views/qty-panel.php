<?php
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="<?= $groupClass ?> btn-group input-group">
        <span class="input-group-btn <?= $qtyMinus ?>">
            <button id="<?= $qtyMinus ?>" class="btn btn-primary qtyMinus qtyPlusMinus" data-id="<?= $id ?>"
                    type="button">
                -
            </button>
        </span>
    <?php
    echo Html::activeInput("text", $model, $attribute, [
        'id' => 'qtyField',
        'class' => 'input form-control input-text qty',
        'type' => 'search',
        'data-placeholder' => '0',
        'value' => $qty,
        'name' => 'keyword',
    ]);
    ?>
    <span class="input-group-btn <?= $qtyPlus ?>">
            <button id="<?= $qtyPlus ?>" class="btn btn-primary qtyPlus qtyPlusMinus" data-id="<?= $id ?>"
                    type="button">
                +
            </button>
        </span>
</div>
