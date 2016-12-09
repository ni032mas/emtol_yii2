<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 08.10.2016
 * Time: 16:31
 */

namespace frontend\controllers;


use yii\rest\ActiveController;

class ObjreservationController extends ActiveController
{
    public $modelClass = 'frontend\models\Objreservation';

    public function actionView()
    {
        return $this->render('index');
    }
}