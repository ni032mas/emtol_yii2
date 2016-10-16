<?php

namespace frontend\controllers;

use frontend\models\Reservationinfo;
use Yii;

class ReservationinfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGet()
    {
        $objreservationId = Yii::$app->request->get('objreservationId');
        $dateBegin = Yii::$app->request->get('dateBegin');
        $reservationinfo= Reservationinfo::findOne([
            'objreservation_id' => $objreservationId,
            'date_begin' => $dateBegin
        ]);
        $this->layout = false;
        if (!empty($reservationinfo)) {
            return $reservationinfo->id;
        } else {
            return false;
        }
    }

}
