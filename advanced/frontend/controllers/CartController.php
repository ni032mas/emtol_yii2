<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 23.08.2016
 * Time: 9:04
 */

namespace frontend\controllers;


use frontend\models\Cart;
use frontend\models\Reservationinfo;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{
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
        $cart->recalc($id);
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

}