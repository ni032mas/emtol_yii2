<?php

namespace backend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class TagController extends \yii\web\Controller {
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionList($query) {
        $models = Tag::findAllByName($query);
        $items = [];
        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        } // We know we can use ContentNegotiator filter // this way is easier to show you here :) Yii::$app->response->format = Response::FORMAT_JSON; return $items; } Read more at: http://yiiwheels.com/extension/yii2-taggable-behavior
    }
}
