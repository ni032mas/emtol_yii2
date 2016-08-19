<?php

namespace common\widgets;

use DateTime;
use frontend\models\Searchfree;
use frontend\models\Tag;
use yii\helpers\ArrayHelper;

class SearchPanel extends \yii\base\Widget
{

    public $dateBegin;

    public function run()
    {
        $model = new Searchfree();
        $data = ArrayHelper::getColumn(Tag::find()->asArray()->all(), 'name');
        return $this->render('search-panel',
            [
                'data' => $data,
                'model' => $model,
                'dateBegin' => $this->dateBegin,
            ]);
    }

    public function init()
    {
        parent::init();
        if ($this->dateBegin === null) {
            $dateB = new DateTime();
            $this->dateBegin = $dateB->format('Y-m-d');
        }

    }
}
