<?php
namespace frontend\controllers;

use frontend\models\Consumers;
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

    public function actionOrders()
    {
        $query = Orders::find()->select('orders.*')
            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id]);
        $queryCount = Orders::find()->select('orders.*')
            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id])
            ->where(['orders.order_status_id' => 1]);
        $ordersCount = $queryCount->count();
        $models = $query->all();
        $actionType = 'orders';
        return $this->render('view', compact('models', 'ordersCount', 'actionType'));
    }

    public function actionProfile()
    {
        $model = Consumers::find()->select('consumers.*')
            ->where(['consumers.user_id' => Yii::$app->user->id])
            ->one();
        $queryActive = Orders::find()->select('orders.*')
            ->leftJoin('orders_status', 'orders.order_status_id = orders_status.id')
            ->leftJoin('consumers', 'orders.consumer_id = consumers.id')
            ->leftJoin('user', 'consumers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id])
            ->where(['orders.order_status_id' => 1]);
        $ordersCount = $queryActive->count();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Данные успешно изменены!');
            } else {
                Yii::$app->session->setFlash('danger', 'Данные не были сохранены!');
            }
        }

        return $this->render('view', [
            'model' => $model,
            'ordersCount' => $ordersCount,
            'actionType' => 'profile',
        ]);
    }
}

?>