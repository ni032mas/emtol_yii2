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

    public function addQty($reservationinfo, $qty)
    {
        if (!isset($_SESSION['cart'][$reservationinfo->id])) {
            return false;
        } else {
            $_SESSION['cart'][$reservationinfo->id] =
                [
                    'name' => $reservationinfo->objreservation->name,
                    'qty' => $qty,
                    'price' => $reservationinfo->price,
                ];
        }
        $this->recalc();
        return true;
    }


    public function recalc() {
        $sum = 0;
        $qty = 0;
        if (!isset($_SESSION['cart'])) {
            return false;
        }
        foreach ($_SESSION['cart'] as $id => $item) {
            $sum = $sum + $item['price'] * $item['qty'];
            $qty = $qty + $item['qty'];
        }
        $_SESSION['cart.qty'] = $qty;
        $_SESSION['cart.sum'] = $sum;
        return true;
    }
//TODO скорее всего удалить
//    public function recalc($id)
//    {
//        if (!isset($_SESSION['cart'][$id])) {
//            return false;
//        }
//        $qtyMinus = $_SESSION['cart'][$id]['qty'];
//        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
//        $_SESSION['cart.qty'] -= $qtyMinus;
//        $_SESSION['cart.sum'] -= $sumMinus;
//        unset($_SESSION['cart'][$id]);
//        return true;
//    }


}