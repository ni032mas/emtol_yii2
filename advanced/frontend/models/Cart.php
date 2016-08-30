<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($reservationinfo, $qty = 1)
    {
        if (isset($_SESSION['cart'][$reservationinfo->id])) {
            $_SESSION['cart'][$reservationinfo->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$reservationinfo->id] =
                [
                    'name' => $reservationinfo->objreservation->name,
                    'qty' => $qty,
                    'price' => $reservationinfo->price,
                ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $reservationinfo->price * $qty : $reservationinfo->price * $qty;
    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }
}