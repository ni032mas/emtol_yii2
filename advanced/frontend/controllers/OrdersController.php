<?php

namespace frontend\controllers;

use frontend\models\Consumers;
use frontend\models\Orders;
use frontend\models\OrdersItem;
use Yii;
use yii\web\Controller;

class OrdersController extends Controller
{
    /**
     * Отменяет заказ
     * @return string
     */
    public function actionCancel()
    {
        $ordersId = Yii::$app->request->get('ordersId');
        $order = Orders::find()
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id])
            ->where(['orders.id' => $ordersId])
            ->one();
        if (!empty($order)) {
            $order->order_status_id = 3;
            $order->save();
        }
//        $query = Orders::find()
//            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
//            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
//            ->leftJoin('user', 'consumers.user_id = user.id')
//            ->where(['user.id' => Yii::$app->user->id]);;
//        $ordersCount = $query->count();
//        $orders = $query->all();
//
//        return $this->render('view', compact('orders', 'ordersCount'));
//        return debug($ordersId);
        return $this->redirect('/my-dashboard/orders');
    }

    public function actionAdd()
    {
        $session = Yii::$app->session;
        $session->open();
        $consumer = Consumers::find()->where(['user_id' => Yii::$app->user->id])->one();
        $order = new Orders();
        if (!empty($consumer) && $order->load(Yii::$app->request->post())) {
            $order->consumer_id = $consumer->id;
            $order->order_status_id = 1;
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrdersItem($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Заказ принят!');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
            }
        }
        return $this->redirect('/my-dashboard/orders');
    }

    protected function saveOrdersItem($items, $orderId)
    {
        foreach ($items as $id => $item) {
            $ordersItem = new OrdersItem();
            $ordersItem->order_id = $orderId;
            $ordersItem->reservationinfo_id = $id;
            $ordersItem->price = $item['price'];
            $ordersItem->qty_item = $item['qty'];
            $ordersItem->sum_item = $item['qty'] * $item['price'];
            $ordersItem->save();
        }
    }

}
