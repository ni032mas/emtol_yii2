<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use backend\models;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $location_id
 * @property integer $contractor_id
 * @property integer $user_id
 * @property string $date_begin
 * @property string $date_end
 * @property string $images
 * @property string $alias
 * @property integer $created_at
 * @property integer $updated_at
 */
class Events extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'location_id', 'contractor_id', 'user_id', 'date_begin', 'date_end', 'images', 'alias', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['location_id', 'contractor_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['date_begin', 'date_end'], 'safe'],
            [['name', 'images'], 'string', 'max' => 500],
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
            'contractor_id' => 'Contractor ID',
            'user_id' => 'User ID',
            'date_begin' => 'Date Begin',
            'date_end' => 'Date End',
            'images' => 'Images',
            'alias' => 'Alias',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getUsers() {
        return $this->hasOne(common\models\User::className(), ['id' => 'user_id']);
    }
    
    public function getContractors() {
        return $this->hasMany(Contractors::className(), ['id' => 'contractors_id']);
    }

}
