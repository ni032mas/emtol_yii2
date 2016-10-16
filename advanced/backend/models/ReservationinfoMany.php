<?php

namespace backend\models;


use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ReservationinfoMany extends Model
{
    public $dateBegin;
    public $dateEnd;
    public $timeBegin;
    public $hour;
    public $qty;
    public $price;
    public $objreservationId;
    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;
    public $everyMonth;


    public function rules()
    {
        return [
            [['objreservationId', 'dateBegin', 'dateEnd', 'qty', 'price', 'hour'], 'required'],
            [['objreservationId', 'qty', 'created_at', 'updated_at', 'hour'], 'integer'],
            [['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], 'boolean'],
            [['price'], 'double'],
            [['everyMonth'], 'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'dateBegin' => 'Дата/Время начала экскурсии',
            'dateEnd' => 'Дата окончания экскурсий',
            'hour' => 'Продолжительность в часах',
            'qty' => 'Количество',
            'price' => 'Цена',
            'monday' => 'Понедельник',
            'tuesday' => 'Вторник',
            'wednesday' => 'Среда',
            'thursday' => 'Четверг',
            'friday' => 'Пятница',
            'saturday' => 'Суббота',
            'sunday' => 'Воскресение',
        ];
    }

    function init()
    {
        $this->dateBegin = Yii::$app->formatter->asDate('now');
        $this->hour = 1;
        $this->qty = 1;
        $this->price = 1;
        $this->monday = true;
        $this->tuesday = true;
        $this->wednesday = true;
        $this->thursday = true;
        $this->friday = true;
        $this->saturday = true;
        $this->sunday = true;
        $this->everyMonth = false;
    }

    public function getObjreservationList()
    {
        $user = User::findOne(Yii::$app->user->id);
        $objreservation = $user->getObjreservation()->all();

        return ArrayHelper::map($objreservation, 'id', 'name');
    }
}