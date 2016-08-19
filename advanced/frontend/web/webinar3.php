<?php
	$h = 70;
	function word($h)
	{
		$w = " минут";
		
		if ($h == 1 ||  $h == 21 || $h == 31 || $h == 41 || $h == 51 ) {
			echo "окончание -а, ";
			$s = $h . $w . "а";
		} elseif (($h > 1 & $h < 5) ||  ($h > 21 & $h< 25)  ||  ($h > 31 & $h< 35) ||  ($h > 41 & $h< 45) ||  ($h > 51 & $h< 55)) {
			echo "окончание -ы, ";
			$s = $h . $w . "ы";
		} elseif ($h > 59 || $h < 0) {
			$s = "ошибка, больше минут нет";
		} else {
			echo "нет окончания, ";
			$s = $h . $w;
		}		
		 return $s;
	}
?>
<!doctype html>
<html>
	<head>
		<title>ДЗ-3</title>	
	</head>
	<body>
		<h1> проверка слова <h1>
			<?php 
			echo word($h)?>
			<br><?= $h ?></br>
	</body>
		
</html>
