<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\UploadForm;
use yii\web\UploadedFile;

class UploadformController extends Controller {

    public function actionUpload() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            Yii::info(UploadedFile::getInstances($model, 'imageFiles'));
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

}
