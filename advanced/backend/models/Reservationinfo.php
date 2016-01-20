<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['objreservation_id', 'date_begin', 'date_end', 'amount', 'created_at', 'updated_at'], 'required'],
            [['objreservation_id', 'date_begin', 'date_end', 'amount', 'created_at', 'updated_at'], 'integer']
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
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'amount' => 'Количество',
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
    public function getObjreservation()
    {
        return $this->hasOne(Objreservation::className(), ['id' => 'objreservation_id']);
    }
}
