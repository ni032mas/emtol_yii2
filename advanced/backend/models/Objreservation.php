<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use Imagine\Image\Box;

/**
 * This is the model class for table "objreservation".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $location_id
 * @property string $customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property Images[] $images
 * @property Locations $location
 * @property Customers $customer
 * @property Orders[] $orders
 * @property Reservationinfo[] $reservationinfos
 */
class Objreservation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'objreservation';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'description', 'keywords', 'location_id', 'customer_id', 'created_at', 'updated_at'], 'required'],
            [['description', 'keywords', 'coordinate'], 'string'],
            [['location_id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'coordinate' => 'Координаты',
            'location_id' => 'Место',
            'customer_id' => 'Исполнитель',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors() {
//        ini_set('memory_limit', '64M');
        return [
            TimestampBehavior::className(),
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'objreservation',
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

//    public function behaviors() {
//        return [
//            TimestampBehavior::className(),
//            'galleryBehavior' => [
//                'class' => GalleryBehavior::className(),
//                'type' => 'product',
//                'extension' => 'jpg',
//                'directory' => Yii::getAlias('@webroot') . '/images/product/gallery',
//                'url' => Yii::getAlias('@web') . '/images/product/gallery',
//                'versions' => [
//                    'small' => function ($img) {
//                        /** @var ImageInterface $img */
//                        return $img
//                                        ->copy()
//                                        ->thumbnail(new Box(200, 200));
//                    },
//                    'medium' => function ($img) {
//                        /** @var ImageInterface $img */
//                        $dstSize = $img->getSize();
//                        $maxWidth = 800;
//                        if ($dstSize->getWidth() > $maxWidth) {
//                            $dstSize = $dstSize->widen($maxWidth);
//                        }
//                        return $img
//                                        ->copy()
//                                        ->resize($dstSize);
//                    },
//                ]
//            ]
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages() {
        return $this->hasMany(Images::className(), ['obj_reservation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation() {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    public function getLocationName() {
        $location = $this->location;
        return $location ? $location->name : '';
    }

    public function getLocationList() {
        $location = Locations::find()
                ->all();

        return ArrayHelper::map($location, 'id', 'name');
    }

    public function getCustomerList() {

        $customers = Customers::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->all();

        return ArrayHelper::map($customers, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    public function getCustomerName() {
        $customer = $this->customer;
        return $customer ? $customer->name : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders() {
        return $this->hasMany(Orders::className(), ['objreservation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationinfos() {
        return $this->hasMany(Reservationinfo::className(), ['obj_reservation_id' => 'id']);
    }

    public function getGallery() {
        return $this->hasOne(GalleryImage::className(), ['id' => 'gallery_id']);
    }

}
