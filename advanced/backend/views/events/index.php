<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h1>События</h1>
<ul>
<?php foreach ($events as $event): ?>
    <li>
        <?=Html::encode("{$event->name} ({$event->description})") ?>:   
    </li>
<?php endforeach; ?>    
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
