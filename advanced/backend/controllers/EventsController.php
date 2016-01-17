<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use backend\models\Events;

class EventsController extends Controller {
    public function actionIndex() {
        $query = Events::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $events = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        return $this->render('index', [
            'events' => $events,
            'pagination' => $pagination,
        ]);
    }
}
