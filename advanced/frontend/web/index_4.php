<?php
    
    if(count($_POST) > 0){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $dateTime = date('Y-m-d h:m:s');
        if ($name == "" || $name == null || iconv_strlen($name) < 2) {
			echo "имя не заполнено или меньше 2 символов";
		} elseif ($phone == "" || $phone == null ) {
			echo "телефон не заполнен";
		} elseif (preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $phone) == 0) {
			echo "телефон не корректен";
		} else  {
			file_put_contents('apps.txt', "$name $phone $dateTime\n", FILE_APPEND);
        
			echo 'Ваша заявка принята, ожидайте звонка!';
		}
    }
?>

<form method="post">
    Имя<br>
    <input type="text" name="name" required><br>
    Телефон<br>
    <input type="text" name="phone"><br>
    <input type="submit" value="Отправить">
</form>