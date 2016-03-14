<?php

namespace frontend\controllers;

use backend\models\Objreservation;

class SearchfreereservationinfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Objreservation;
        return $this->render('index', [
            'model' => $model->getFreeObjreservation(),
        ]);
    }

}
