<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $objreservation_id
 * @property string $consumer_id
 * @property string $reserved_amount
 * @property integer $paid
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Objreservation $objReservation
 * @property Consumers $consumer
 */
class Orders extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objreservation_id', 'reservationinfo_id', 'consumer_id', 'reserved_amount', 'paid', 'order_status_id', 'created_at', 'updated_at'], 'required'],
            [['objreservation_id', 'reservationinfo_id', 'consumer_id', 'reserved_amount', 'order_status_id', 'created_at', 'updated_at'], 'integer'],
            [['paid'], 'number'],
            [['comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objreservation_id' => 'Obj Reservation ID',
            'reservationinfo_id' => 'Дата начала',
            'consumer_id' => 'Клиент',
            'reserved_amount' => 'Количество',
            'paid' => 'Оплачено',
            'order_status_id' => 'Статус',
            'comment' => 'Комментарий',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjReservation()
    {
        return $this->hasOne(Objreservation::className(), ['id' => 'objreservation_id']);
    }

    public function getObjreservationName()
    {
        $objreservation = $this->objReservation;
        return $objreservation ? $objreservation->id . ': ' . $objreservation->name : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsumer()
    {
        return $this->hasOne(Consumers::className(), ['id' => 'consumer_id']);
    }

    public function getConsumerName()
    {
        $consumer = $this->consumer;
        return $consumer ? $consumer->name : '';
    }

    public function getOrderStatus()
    {
        return $this->hasOne(OrdersStatus::className(), ['id' => 'order_status_id']);
    }

    public function getOrderStatusList()
    {
        $location = OrdersStatus::find()
            ->all();

        return ArrayHelper::map($location, 'id', 'name');
    }

    public function getOrderStatusName()
    {
        $orderStatus = $this->orderStatus;
        return $orderStatus ? $orderStatus->name : '';
    }


    public function getReservationinfo()
    {
        return $this->hasOne(Reservationinfo::className(), ['id' => 'reservationinfo_id']);
    }

    public function getReservationinfoDate()
    {
        $reservationinfo = $this->reservationinfo;
        return $reservationinfo ? $reservationinfo->date_begin : '';
    }

    public function getUrlReservationInfo() {
        $objreservation_id = $this->id;
        return \Yii::$app->urlManager->createUrl(['reservationinfo/view', 'id' => $objreservation_id]);
    }

    public function getUrlObjreservation() {
        $objreservation_id = $this->id;
        return \Yii::$app->urlManager->createUrl(['objreservation/view', 'id' => $objreservation_id]);
    }

}
