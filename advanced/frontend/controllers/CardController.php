<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 23.08.2016
 * Time: 9:04
 */

namespace frontend\controllers;


use frontend\models\Card;
use frontend\models\Reservationinfo;
use Yii;
use yii\web\Controller;

class CardController extends Controller
{
    public function actionAdd()
    {
        $reservationInfoId = Yii::$app->request->get('reservationInfoId');
        $qty = Yii::$app->request->get('qty');
        $reservationinfo = Reservationinfo::find()->select('reservationinfo.*')
            ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
            ->where(['=', 'reservationinfo.id', $reservationInfoId])
            ->all();
        $session = Yii::$app->session;
        $session->open();
        $card = new Card();
        $card->addToCard($reservationinfo);
        debug($reservationinfo);
    }

}