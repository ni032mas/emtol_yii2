<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use common\models\User;

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
//            [['objreservation_id', 'reservationinfo_id', 'date_begin', 'date_end', 'qty', 'created_at', 'updated_at'], 'required'],
//            [['objreservation_id', 'reservationinfo_id', 'qty', 'created_at', 'updated_at'], 'integer'],
            [['objreservation_id', 'date_begin', 'date_end', 'qty', 'created_at', 'updated_at'], 'required'],
            [['objreservation_id', 'qty', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'double'],
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
//            'reservationinfo_id' => 'Reservationinfo',
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'qty' => 'Количество',
            'price' => 'Цена',
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
        $user = User::findOne(Yii::$app->user->id);
        $objreservation = $user->getObjreservation()->all();

        return ArrayHelper::map($objreservation, 'id', 'name');
    }
    
    public function getObjreservationName() {
        $objreservation = $this->objreservation;
        return $objreservation ? $objreservation->name : '';
    }


}
