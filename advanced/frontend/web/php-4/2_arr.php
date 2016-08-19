<?php
    error_reporting(E_ALL);
    /* $arr = ['Москва', 'Париж', 'Лондон', 'Минск', 'Пекин', 'Киев'];
    
    for($i = 0; $i < count($arr); $i++){
        echo $arr[$i] . '<br>';
    } */
   
    $capitals = [
        'Россия' => 'Москва', 
        'Франция' => 'Париж',  
        'Англия' => 'Лондон', 
        'Беларусь' => 'Минск', 
        'Китай' => 'Пекин', 
        'Украина' => 'Киев'
    ];
    
    foreach($capitals as $country => $capital){
        echo "$country - $capital<br>";
    }
    
    foreach($capitals as $capital){
        echo "$capital<br>";
    }
    
    /* echo '<pre>';
    print_r($arr);
    echo '</pre>'; */