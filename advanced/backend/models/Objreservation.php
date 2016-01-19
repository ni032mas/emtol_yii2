<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "objreservation".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $location_id
 * @property string $customer_id
 * @property string $alias
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Images[] $images
 * @property Locations $location
 * @property Customers $customer
 * @property Orders[] $orders
 * @property Reservationinfo[] $reservationinfos
 */
class Objreservation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objreservation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'location_id', 'customer_id', 'alias', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['location_id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'location_id' => 'Location ID',
            'customer_id' => 'Customer ID',
            'alias' => 'Alias',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['obj_reservation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['obj_reservation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationinfos()
    {
        return $this->hasMany(Reservationinfo::className(), ['obj_reservation_id' => 'id']);
    }
}
