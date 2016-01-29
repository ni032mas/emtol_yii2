<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
            [['objreservation_id', 'amount', 'created_at', 'updated_at'], 'integer'],
            [['date_begin', 'date_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objreservation_id' => 'Экскурсия',
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
    
    public function getObjreservationList() {
        $objreservation = Objreservation::find()
                ->all();

        return ArrayHelper::map($objreservation, 'id', 'name');
    }
    
    public function getObjreservationName() {
        $objreservation = $this->objreservation;
        return $objreservation ? $objreservation->name : '';
    }

}
