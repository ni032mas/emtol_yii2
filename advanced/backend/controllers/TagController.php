<?php

namespace backend\controllers;

class TagController extends \yii\web\Controller {

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
