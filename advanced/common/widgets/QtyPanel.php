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
    public $qtyMinus;
    public $qtyPlus;

    public function run()
    {
        return $this->render('qty-panel',
            [
                'model' => $this->model,
                'attribute' => $this->attribute,
                'id' => $this->id,
                'qty' => $this->qty,
                'groupClass' => $this->groupClass,
                'qtyMinus' => $this->qtyMinus,
                'qtyPlus' => $this->qtyPlus,
            ]);
    }

//    public function init() {
//        parent::init();
//    }
}
