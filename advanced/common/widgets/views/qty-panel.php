<?php
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="<?= $groupClass ?> btn-group input-group">
        <span class="input-group-btn <?= $qtyMinusId ?>">
            <button id="<?= $qtyMinusId ?>" class="btn btn-primary qtyMinus qtyPlusMinus <?= $qtyMinusClass ?>" onclick="qtyMinus(<?= $id ?>)" data-id="<?= $id ?>"
                    type="button">
                -
            </button>
        </span>
    <?php
    echo Html::activeInput("text", $model, $attribute, [
        'id' => 'qtyField' . $id,
        'class' => 'input form-control input-text qty qtyField ' . $qtyFieldClassCartView,
        'type' => 'search',
        'data-placeholder' => '0',
        'value' => $qty,
        'name' => 'keyword',
        'data-id' => $id
    ]);
    ?>
    <span class="input-group-btn <?= $qtyPlusId ?>">
            <button id="<?= $qtyPlusId . $id ?>" class="btn btn-primary qtyPlus qtyPlusMinus <?= $qtyPlusClass ?>" onclick="qtyPlus(<?= $id ?>)" data-id="<?= $id ?>"
                    type="button">
                +
            </button>
        </span>
</div>
