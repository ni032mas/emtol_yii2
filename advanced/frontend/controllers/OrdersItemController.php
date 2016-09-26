<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 14.09.2016
 * Time: 19:55
 */

namespace frontend\controllers;


use frontend\models\OrdersItem;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class OrdersItemController extends Controller
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

    function actionView()
    {
        $ordersId = Yii::$app->request->get('ordersId');
        $ordersItem = OrdersItem::find()->select('orders_item.*')
            ->leftJoin('reservationinfo', 'reservationinfo.id = orders_item.reservationinfo_id')
            ->rightJoin('objreservation', 'objreservation.id = reservationinfo.objreservation_id')
            ->where(['=', 'orders_item.order_id', $ordersId])
            ->all();
        $this->layout = false;
        return $this->render('view', compact('ordersItem', 'ordersId'));
    }
}