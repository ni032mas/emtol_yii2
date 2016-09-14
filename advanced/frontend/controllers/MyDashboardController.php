<?php
namespace frontend\controllers;

use frontend\models\Orders;
use frontend\models\OrdersItem;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class MyDashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionOrders(){
        $query = Orders::find()
            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id]);
        ;
        $ordersCount = $query->count();
        $orders = $query->all();
        return $this->render('view', compact('orders', 'ordersCount'));
    }

    public function actionProfile(){
        $query = Orders::find()
            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id]);
        ;
        $ordersCount = $query->count();
        $orders = $query->all();
        return $this->render('view', compact('orders', 'ordersCount'));
    }
}
?>