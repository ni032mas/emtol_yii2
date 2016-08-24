<?php

namespace frontend\controllers;

use backend\models\Reservationinfo;
use frontend\models\Objreservation;
use frontend\models\SelectDateTimePrice;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class SearchfreereservationinfoController extends Controller
{
    public function actionIndex($sort = 'desc', $dateBegin = null)
    {
        if (Yii::$app->request->post('Searchfree')['date_begin']) {
            $dateBegin = Yii::$app->request->post('Searchfree')['date_begin'];
        }

        if ($sort == 'desc') {
            $query = Reservationinfo::find()->select('reservationinfo.*')
                ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
                ->where(['>=', 'reservationinfo.date_begin', strtotime($dateBegin)])
                ->addOrderBy(['price' => SORT_DESC,]);
        } else if ($sort == 'asc') {
            $query = Reservationinfo::find()->select('reservationinfo.*')
                ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
                ->where(['>=', 'reservationinfo.date_begin', strtotime($dateBegin)])
                ->addOrderBy(['price' => SORT_ASC,]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'dateBegin' => $dateBegin,
            'sort' => $sort,
        ]);
    }

    public function actionView($dateBegin = null, $id = null)
    {
        if (Yii::$app->request->post('Searchfree')['date_begin']) {
            $dateBegin = Yii::$app->request->post('Searchfree')['date_begin'];
        }
        $modelPrice = new SelectDateTimePrice();
        $models = Reservationinfo::find()->select('reservationinfo.*')
            ->leftJoin('objreservation', 'reservationinfo.objreservation_id = objreservation.id')
            ->where(['>=', 'reservationinfo.date_begin', strtotime($dateBegin)])
            ->where(['=', 'objreservation.id', $id])
            ->addOrderBy(['reservationinfo.date_begin' => SORT_ASC, 'price' => SORT_ASC,])->all();

        return $this->render('view', [
            'models' => $models,
            'dateBegin' => $dateBegin,
            'id' => $id,
            'modelPrice' => $modelPrice,
        ]);
    }
}
