<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
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
            [['objreservation_id', 'date_begin', 'date_end', 'qty'], 'required'],
            [['objreservation_id', 'qty', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'double'],
            [['date_begin', 'date_end',], 'safe']
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
            'qty' => 'Количество',
            'price' => 'Цена',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjreservation()
    {
        return $this->hasOne(Objreservation::className(), ['id' => 'objreservation_id']);
    }
    

    public function getObjreservationList()
    {
        $user = User::findOne(Yii::$app->user->id);
        $objreservation = $user->getObjreservation()->all();
        
        return ArrayHelper::map($objreservation, 'id', 'name');
    }

    public function getObjreservationName()
    {
        $objreservation = $this->objreservation;
        return $objreservation ? $objreservation->name : '';
    }
    

    public function getDateBegin() {
        return $this->date_begin;
    }
    public function getDateEnd() {

    }
}
