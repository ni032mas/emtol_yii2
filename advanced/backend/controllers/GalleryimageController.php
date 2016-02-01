<?php

namespace backend\controllers;

use zxbodya\yii2\galleryManager\GalleryManagerAction;
use zxbodya\yii2\galleryManager\GalleryManager;
use yii\web\Controller;
use backend\models\Galleryimage;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class GalleryimageController extends Controller {

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
                        'actions' => ['gallery', 'index'],
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

    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'galleryimage' => Galleryimage::className()
                ]
            ],
        ];
    }

    public function actionGallery() {

        $model = \backend\models\Objreservation::findOne(3);

        return $this->render('index', [
                    'model' => $model,
        ]);
    }

}
