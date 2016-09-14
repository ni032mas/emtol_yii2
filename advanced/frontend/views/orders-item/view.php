<?php use yii\helpers\Url;
if (!empty($ordersItem)) : ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ordersItem as $item): ?>
                <tr>
                    <td><?= $item->reservationinfo->objreservation->name ?></a></td>
                    <td><?= $item->qty_item ?></td>
                    <td><?= $item->price ?></td>
                    <td><?= $item->sum_item ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>

    <h3>Заказ пустой</h3>

<?php endif; ?>