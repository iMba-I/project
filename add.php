<?php
require "db.php";

include "ConClass.php";
include "servicesClass.php";
include "Workers.php";
require_once "logic.php";
require_once "lastlogic.php"

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php require_once 'head.php'?>
        <title>Регистрация</title>
    </head>
    <body>
<?php require_once 'header.php'?>
<h1>Добавить товар</h1>
<form method="post" enctype="multipart/form-data" class="d-flex flex-wrap">
    <input style='width: 200px; margin-bottom: 15px' class="form-control" type="text" name="id" placeholder="Id заказа" value="<?php echo htmlspecialchars($id)?>">
    <input style='width: 200px; margin-left: 15px; margin-bottom: 15px' class="form-control" type="file" name="file" >
    <input style='width: 200px; margin-left: 15px; margin-bottom: 15px' class="form-control" type="text" name="name" placeholder="Название услуги" value="<?php echo htmlspecialchars($name)?>">
    <input style='width: 200px; margin-left: 15px; margin-bottom: 15px' class="form-control" type="text" name="des" placeholder="Описание"value="<?php echo htmlspecialchars($des)?>">
    <input style='width: 200px; margin-left: 15px; margin-bottom: 15px' class="form-control" type="text" name="cost" placeholder="Цена"value="<?php echo htmlspecialchars($cost)?>">
    <select style='width: 200px; margin-left: 15px; margin-bottom: 15px' class="form-select" name="worker" aria-label="">
        <?php
        $arr = Workers::show();
        foreach( $arr as $elem)
        {
            echo " <option selected value='" . $elem['id'] . "'>" . $elem['title'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="otprav" value="Отправить">
</form>
<?php
foreach ($errors as $err) {
    echo $err ."<br>";
}
?>
</center>
    </BODY>
</HTML>
