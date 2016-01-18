<?php

namespace backend\models;

use Yii;
use backend\models;

/**
 * This is the model class for table "contractors".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Contractors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 500]
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getEvents() {
        return $this->hasMany(Events::className(), ['contractors_id' => 'id']);
    }
    
    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

}
