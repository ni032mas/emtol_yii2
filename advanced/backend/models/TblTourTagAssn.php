<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_tour_tag_assn".
 *
 * @property integer $tour_id
 * @property integer $tag_id
 */
class TblTourTagAssn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tour_tag_assn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'tag_id'], 'required'],
            [['tour_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tour_id' => 'Tour ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
