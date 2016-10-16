<?php use backend\models\Orders;
use common\widgets\QtyPanel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td>
                        <a href="<?= Url::to(['/tour/item', 'id' => $id]) ?>"><?= $item['name'] ?></a>
                    </td>
                    <td>
                        <?php
                        echo QtyPanel::widget([
                            'id' => $id,
                            'qty' => $item['qty'],
                            'groupClass' => 'product cart-product-qty',
                            'qtyMinusId' => 'qtyMinus',
                            'qtyMinusClass' => 'qtyMinusCartView',
                            'qtyPlusId' => 'qtyPlus',
                            'qtyPlusClass' => 'qtyPlusCartView',
                            'qtyFieldClassCartView' => 'qtyFieldClassCartView',
                        ]);
                        ?>
                    </td>
                    <td><?= $item['price'] ?></td>
                    <td><span class="glyphicon glyphicon-remove text-danger del-item-cart" data-id="<?= $id ?>"
                              aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Итого:</td>
                <td id="qty-modal"><?php echo $session['cart.qty']; ?></td>
            </tr>
            <tr>
                <td colspan="3">На сумму:</td>
                <td id="sum-modal"><?php echo $session['cart.sum']; ?></td>
            </tr>
            </tbody>
        </table>
        <?php $form = ActiveForm::begin();
        $form->action = '/orders/add';
        if (empty($model)) {
            $model = new Orders();
        }
        ?>

        <?= $form->field($model, 'comment')->textInput(['maxlength' => true])->hint('Введите комментарий') ?>

        <div class="form-group">
            <?= Html::submitButton('Заказать', ['class' =>'btn pull-right btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php else: ?>

    <h3>Корзина пуста</h3>

<?php endif; ?>