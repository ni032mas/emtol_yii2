<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reviews".
 *
 * @property integer $id
 * @property integer $objreservation_id
 * @property integer $consumers_id
 * @property string $comment
 * @property integer $rating
 * @property string $created_at
 * @property string $updated_at
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'objreservation_id', 'consumers_id', 'comment', 'rating', 'created_at', 'updated_at'], 'required'],
            [['id', 'objreservation_id', 'consumers_id', 'rating', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
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
            'consumers_id' => 'Consumers ID',
            'comment' => 'Комментарий',
            'rating' => 'Оценка',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
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
}
