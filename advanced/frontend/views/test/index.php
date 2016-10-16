<?php


use dosamigos\datetimepicker\DateTimePicker;

//echo DateTimePicker::widget([
//    'name' => 'dosam',
//    'options' => [
//        'lang' => 'ru',
//        'allowDates' => ['09.10.2016', '12.10.2016',],
//        'disabledDates' => ['09.10.2016', '13.10.2016',],
//        'formatDate' => 'd.m.Y'
//    ]
//]);

echo \vakorovin\datetimepicker\Datetimepicker::widget([
    'name' => 'dosam',
    'id' => 'testdatetimepicker',
    'options' => [
        'lang' => 'ru',
        'format' => 'Y-m-d H:i'
//        'inline' => true,
//        'allowDates' => ['09.10.2016', '14.10.2016',],
//        'allowTimes' => ['20:00',],
//        'disabledDates' => ['09.10.2016', '13.10.2016',],
    ]
]);
?>

<div id="testid">DateTime</div>
<a href="#" id="testbutton" class="btn btn-default">Convert DateTime</a>
<!-- /.testid -->
