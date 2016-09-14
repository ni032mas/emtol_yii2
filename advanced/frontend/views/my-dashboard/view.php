<?php
use kartik\widgets\SideNav;
use yii\helpers\Url;

$type = SideNav::TYPE_DEFAULT;
?>
<div class="row">
    <div class="col-md-3">
        <?php
        echo SideNav::widget([
            'type' => $type,
            'encodeLabels' => false,
            'heading' => false,
            'items' => [
                // Important: you need to specify url as 'controller/action',
                // not just as 'controller' even if default action is used.
                ['label' => '<span class="pull-right badge">' . $ordersCount . '</span> Заказы', 'icon' => 'th-list', 'url' => Url::to(['/my-dashboard/orders', 'type' => $type]), 'active' => true],
                ['label' => 'Профиль', 'icon' => 'user', 'url' => Url::to(['/my-dashboard/profile', 'type' => $type]),],
            ],
        ]);
        ?>
    </div><!-- /.col-md-3 -->
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Комментарий</th>
                    <th>К оплате</th>
                    <th>Содержимое заказа</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= date("d/m/Y H:i:s", $order->created_at) ?></td>
                        <td><?= $order->comment ?></td>
                        <td><?= $order->sum ?></td>
                        <td><a href="#" class="open-order-item" data-id="<?= $order->id?>">Открыть заказ</a></td>
                        <td><span class="glyphicon glyphicon-remove text-danger del-item-cart"
                                  data-id="<?= $order->id ?>"
                                  aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /.col-md-9 -->
</div><!-- /.row -->


