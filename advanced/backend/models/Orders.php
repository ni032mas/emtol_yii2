<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $consumer_id
 * @property string $qty
 * @property double $sum
 * @property double $paid
 * @property string $order_status_id
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
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
            [['consumer_id', 'qty', 'sum', 'paid', 'order_status_id', 'created_at', 'updated_at'], 'required'],
            [['consumer_id', 'qty', 'order_status_id', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'paid'], 'number'],
            [['comment'], 'string'],
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'consumer_id' => 'Consumer ID',
            'qty' => 'Количество',
            'sum' => 'Сумма',
            'paid' => 'Оплачено',
            'order_status_id' => 'Order Status ID',
            'comment' => 'Комментарий',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

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

    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getUrlReservationInfo()
    {
        $order_id = $this->id;
        return \Yii::$app->urlManager->createUrl(['orders-item/items', 'order_id' => $order_id]);
    }
}
