<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reservationinfo".
 *
 * @property string $id
 * @property string $obj_reservation_id
 * @property string $date_begin
 * @property string $date_end
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Objreservation $objReservation
 */
class Reservationinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservationinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obj_reservation_id', 'date_begin', 'date_end', 'created_at', 'updated_at'], 'required'],
            [['obj_reservation_id', 'date_begin', 'date_end', 'created_at', 'updated_at'], 'integer']
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
            'date_begin' => 'Date Begin',
            'date_end' => 'Date End',
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
