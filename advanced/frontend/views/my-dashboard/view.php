<?php
use kartik\widgets\SideNav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
                ['label' => $ordersCount > 0 ? '<span class="pull-right badge">' . $ordersCount . '</span> Заказы' : 'Заказы', 'icon' => 'th-list', 'url' => Url::to(['/my-dashboard/orders', 'type' => $type]), 'active' => $actionType == 'orders'],
                ['label' => 'Профиль', 'icon' => 'user', 'url' => Url::to(['/my-dashboard/profile', 'type' => $type]), 'active' => $actionType == 'profile'],
            ],
        ]);
        ?>
    </div><!-- /.col-md-3 -->
    <?php
    if ($actionType == 'orders') :
        ?>
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Номер заказа</th>
                        <th>Дата заказа</th>
                        <th>Статус</th>
                        <th>Комментарий</th>
                        <th>К оплате</th>
                        <th>Содержимое заказа</th>
                        <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($models as $model): ?>
                        <tr>
                            <td><?= $model->id ?></td>
                            <td><?= date("d/m/Y H:i:s", $model->created_at) ?></td>
                            <td><?= $model->orderStatus->name ?></td>
                            <td><?= $model->comment ?></td>
                            <td><?= $model->sum ?></td>
                            <td><a href="#" class="open-order-item" data-id="<?= $model->id ?>">Просмотреть заказ</a>
                            </td>
                            <td><span
                                    class="glyphicon glyphicon-remove <?= $model->order_status_id == 1 ? 'text-danger cancel-order' : 'text-default' ?>"
                                    data-id="<?= $model->id ?>" aria-hidden="true"></span></td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.col-md-9 -->
        <?php
    elseif ($actionType == 'profile') :
        ?>
        <div class="col-md-9">
            <div class="my-dashboard-profile">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'first_name') ?>
                <?= $form->field($model, 'last_name') ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div><!-- my-dashboard-profile -->
        </div><!-- /.col-md-9 -->
        <?php
    endif;
    ?>
</div><!-- /.row -->


