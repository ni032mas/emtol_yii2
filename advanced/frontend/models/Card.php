<?php
/**
 * Created by PhpStorm.
 * User: ni032
 * Date: 23.08.2016
 * Time: 9:02
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class Card extends ActiveRecord
{
    public function addToCard($reservationinfo)
    {
        echo 'Worked!';
    }
}