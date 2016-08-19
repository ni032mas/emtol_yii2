<?php

namespace common\widgets;

use DateTime;
use frontend\models\Searchfree;
use frontend\models\SelectDateTimePrice;
use frontend\models\Tag;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class QtyPanel extends Widget
{
    public $model;
    public $attribute;

    public function run()
    {
        return $this->render('qty-panel',
            [
                'model' => $this->model,
                'attribute' => $this->attribute,
            ]);
    }

//    public function init() {
//        parent::init();
//    }
}
