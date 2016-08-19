<?php
    
    if(count($_POST) > 0){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        
        file_put_contents('apps.txt', "$name $phone\n", FILE_APPEND);
        
        echo 'Ваша заявка принята, ожидайте звонка!';
    }
?>

<form method="post">
    Имя<br>
    <input type="text" name="name" required><br>
    Телефон<br>
    <input type="text" name="phone"><br>
    <input type="submit" value="Отправить">
</form>