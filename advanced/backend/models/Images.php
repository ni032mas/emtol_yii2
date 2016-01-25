<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\FileStorage;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $obj_reservation_id
 * @property string $name
 * @property string $thumbnail
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Objreservation $objReservation
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obj_reservation_id', 'name', 'thumbnail', 'created_at', 'updated_at'], 'required'],
            [['obj_reservation_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'obj_reservation_id' => 'Obj Reservation ID',
            'name' => 'Название',
            'name' => 'Миниатюра',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjReservation()
    {
        return $this->hasOne(Objreservation::className(), ['id' => 'obj_reservation_id']);
    }
}
