<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 23.08.2016
 * Time: 9:04
 */

namespace frontend\controllers;


use frontend\models\Cart;
use frontend\models\Orders;
use frontend\models\Reservationinfo;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CartController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['add', 'clear', 'del-item', 'show'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'clear', 'del-item', 'show', 'view', 'add-qty'],
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

    public function actionAdd()
    {
        $reservationInfoId = Yii::$app->request->get('reservationInfoId');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $reservationinfo = Reservationinfo::find()->select('reservationinfo.*')
            ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
            ->where(['=', 'reservationinfo.id', $reservationInfoId])
            ->one();
        $session = Yii::$app->session;
        $session->open();
        $card = new Cart();
        $card->addToCart($reservationinfo, $qty);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $model = new Orders();
        $this->view->title = 'Корзина';
        return $this->render('view', compact('session', 'model'));
    }

    public function actionAddQty()
    {
        $id = Yii::$app->request->get('id');
        $qty = Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $reservationinfo = Reservationinfo::find()->select('reservationinfo.*')
            ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
            ->where(['=', 'reservationinfo.id', $id])
            ->one();
        $session = Yii::$app->session;
        $session->open();
        $card = new Cart();
        $card->addQty($reservationinfo, $qty);
        $this->view->title = 'Корзина';
        $model = new Orders();
        return $this->render('view', compact('session', 'model'));
    }

}