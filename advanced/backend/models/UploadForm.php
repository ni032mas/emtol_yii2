<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\FileStorage;
use yii\imagine\Image;
use yii;

define('DIR_IMAGE', Yii::getAlias('@backend/web/uploads/'));
define('NESTING_DEPTH', 2);

class Uploadform extends Model {

    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules() {
        return [
            [['imageFiles'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false, 'maxFiles' => 4],
        ];
    }

    public function upload() {
        Yii::info($this->imageFiles);
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $temp_name = DIR_IMAGE . time() . '_' . rand(1, 5000) . '.' . $file->extension;
                $file->saveAs($temp_name);
                $this->put($temp_name, TRUE);
                $this->put($temp_name);
            }
            return true;
        } else {
            Yii::info('Hello false');
            return false;
        }
    }

    public function put($file_name, $thumbnail = FALSE, $copy = FALSE) {
        //	Проверяем наличие файла
        if (file_exists($file_name)) {
            //	Получаем расширение
            $file = explode(".", $file_name);
            $ext = $file[count($file) - 1];
            //	Формируем имя файла в хранилище
            $md_name = md5_file($file_name);
            $md_name = $md_name . '.' . $ext;
            if ($thumbnail) {
                $patch = $this->_storagePath($md_name, DIR_IMAGE . 'thumb') . '/' . $md_name;
                Image::thumbnail($file_name, 120, 120)
                        ->save(Yii::getAlias($patch), ['quality' => 80]);
            } else {
                $patch = $this->_storagePath($md_name, DIR_IMAGE) . '/' . $md_name;
                rename($file_name, $patch);
            }
            /*if ($copy) {
                //	Копируем файл в хранилище под новым именем
                copy($file_name, $patch);
            } else {
                //	Перемещаем файл в хранилище под новым именем
                rename($file_name, $patch);
            } */
            return $md_name;
        } else {
            return FALSE;
        }
    }

    private function _storagePath($file_name, $store_path) {
        for ($i = 0; $i < NESTING_DEPTH; $i++) {
            $start = $i * 2;
            $store_path = $store_path . '/' . substr($file_name, $start, 2);
            @mkdir($store_path);
        }
        return $store_path;
    }

}
