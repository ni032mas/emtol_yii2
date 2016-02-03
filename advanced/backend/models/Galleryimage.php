<?php

namespace backend\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use yii\db\ActiveRecord;
use Imagine\Image\Box;

/**
 * This is the model class for table "galleryimage".
 *
 * @property integer $id
 * @property string $type
 * @property string $ownerId
 * @property integer $rank
 * @property string $name
 * @property string $description
 */
class Galleryimage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ownerId'], 'required'],
            [['rank'], 'integer'],
            [['description'], 'string'],
            [['type', 'ownerId', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'ownerId' => 'Owner ID',
            'rank' => 'Rank',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }
}
