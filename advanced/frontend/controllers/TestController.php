<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 30.09.2016
 * Time: 10:52
 */

namespace frontend\controllers;


use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTesttime()
    {
//        $dt = Yii::$app->request->get('dt');
        $dt = Yii::$app->formatter->asDatetime('2016-10-16 16:00');
        $dt0 = 1476633600;
        $dt1 = Yii::$app->formatter->asDatetime(1476633600);
        $dt2 = Yii::$app->formatter->asTimestamp($dt1);
        $dt3 = Yii::$app->formatter->asDatetime($dt2);
        $dt4 = Yii::$app->formatter->asTimestamp($dt3);
        return $dt . ' ' .$dt0 . ' ' . $dt1 . ' ' . $dt2 . ' ' . $dt3 . ' ' . $dt4;
    }


}