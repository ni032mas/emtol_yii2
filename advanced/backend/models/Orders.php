<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $obj_reservation_id
 * @property string $consumer_id
 * @property string $reserved_amount
 * @property integer $is_paid
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
            [['obj_reservation_id', 'consumer_id', 'reserved_amount', 'is_paid', 'created_at', 'updated_at'], 'required'],
            [['obj_reservation_id', 'consumer_id', 'reserved_amount', 'is_paid', 'created_at', 'updated_at'], 'integer'],
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
            'obj_reservation_id' => 'Obj Reservation ID',
            'consumer_id' => 'Consumer ID',
            'reserved_amount' => 'Reserved Amount',
            'is_paid' => 'Is Paid',
            'comment' => 'Comment',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsumer()
    {
        return $this->hasOne(Consumers::className(), ['id' => 'consumer_id']);
    }
}