<?php

namespace frontend\models;


use yii\base\Model;

class SelectDateTimePrice extends Model
{
    public $reservationId;
    public $qty;

    public function attributeLabels()
    {
        return [
            'reservationId' => 'Выберете дату/время и цену',
            'qty' => 'Количество',
        ];
    }

}