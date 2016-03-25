<?php

namespace frontend\models;


use yii\base\Model;

class Searchfree extends Model
{
    public $date_begin;
    public $search_data;

    public function attributeLabels()
    {
        return [
            'date_begin' => 'Дата начала',
            'search_data' => 'Что вы хотите посмотреть',
        ];
    }
}