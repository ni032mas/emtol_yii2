<?php

namespace common\widgets;

use DateTime;
use frontend\models\Tour;
use frontend\models\SelectDateTimePrice;
use frontend\models\Tag;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class QtyPanel extends Widget
{
    public $model;
    public $attribute;
    public $id;
    public $qty;
    public $groupClass;
    public $qtyMinusId;
    public $qtyMinusClass;
    public $qtyPlusId;
    public $qtyPlusClass;
    public $qtyFieldClassCartView;

    public function run()
    {
        return $this->render('qty-panel',
            [
                'model' => $this->model,
                'attribute' => $this->attribute,
                'id' => $this->id,
                'qty' => $this->qty,
                'groupClass' => $this->groupClass,
                'qtyMinusId' => $this->qtyMinusId,
                'qtyMinusClass' => $this->qtyMinusClass,
                'qtyPlusId' => $this->qtyPlusId,
                'qtyPlusClass' => $this->qtyPlusClass,
                'qtyFieldClassCartView' => $this->qtyFieldClassCartView,
            ]);
    }

//    public function init() {
//        parent::init();
//    }
}
