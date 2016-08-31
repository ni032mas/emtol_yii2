<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders_item".
 *
 * @property string $id
 * @property string $order_id
 * @property string $reservationinfo_id
 * @property double $price
 * @property string $qty_item
 * @property double $sum_item
 */
class OrdersItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_item';
    }

    /**
     * @inheritdoc
     */

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function rules()
    {
        return [
            [['order_id', 'reservationinfo_id', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'reservationinfo_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Номер заказа',
            'reservationinfo_id' => 'Reservationinfo ID',
            'price' => 'Цена',
            'qty_item' => 'Количество',
            'sum_item' => 'Сумма',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['order_id' => 'id']);
    }

    public function getReservationinfo()
    {
        return $this->hasOne(Reservationinfo::className(), ['id' => 'reservationinfo_id']);
    }

    public function getObjreservationName()
    {
//        $objreservation = $this->reservationinfo->objreservationName;
//        return $objreservation ? $objreservation->name : '';
        $objreservation = $this->reservationinfo->objreservationName;
        return $objreservation;
    }
}
