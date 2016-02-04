<?php

namespace backend\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use Imagine\Image\Box;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $product
 * @property integer $gallery_id
 * @property string $file_name
 *
 * @property GalleryImage $gallery
 */
class Product extends \yii\db\ActiveRecord {

    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_product';
    }

    public function behaviors() {
//        ini_set('memory_limit', '64M');
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'product',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/images/product/gallery',
                'url' => Yii::getAlias('@web') . '/images/product/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                                        ->copy()
                                        ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product'], 'required'],
            [['gallery_id'], 'integer'],
            [['product'], 'string', 'max' => 125],
            [['file_name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'gallery_id' => 'Gallery ID',
            'file_name' => 'File Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery() {
        return $this->hasOne(GalleryImage::className(), ['id' => 'gallery_id']);
    }
}
