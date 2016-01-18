<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $reserved_amount
 * @property integer $is_paid
 * @property string $comment
 * @property integer $created_at
 * @property integer $updated_at
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
            [['event_id', 'user_id', 'reserved_amount', 'is_paid', 'created_at', 'updated_at'], 'required'],
            [['event_id', 'user_id', 'reserved_amount', 'is_paid', 'created_at', 'updated_at'], 'integer'],
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
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
            'reserved_amount' => 'Reserved Amount',
            'is_paid' => 'Is Paid',
            'comment' => 'Comment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
