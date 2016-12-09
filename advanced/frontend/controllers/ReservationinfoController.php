<?php

namespace frontend\controllers;

use frontend\models\Reservationinfo;
use Yii;
use yii\rest\ActiveController;

class ReservationinfoController extends ActiveController
{
    public $modelClass = 'frontend\models\Reservationinfo';
    
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete" и "create"
        unset($actions['delete'], $actions['create']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['get'] = ['getTest'];

        return $actions;
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

    public function getTest()
    {
        return 'Test';
    }

}
