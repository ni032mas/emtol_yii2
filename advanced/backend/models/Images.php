<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $obj_reservation_id
 * @property string $name
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
            [['obj_reservation_id', 'name', 'created_at', 'updated_at'], 'required'],
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
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
