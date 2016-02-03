<?php

$s1 = '<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <title>Документ без названия</title>
    </head>
    <body>';
$s2 = '';
for ($i = 0; $i < 5; $i++) { 
	$s2 = $s2 . '<p>Привет Мир!</p>'; 	 			
}		
  
$s3 = '</body> </html>';

echo $s1 . $s2 . $s3;

?>
