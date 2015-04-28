<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
        echo "Id user  ".$_SESSION['id_user'];
        echo "<br>FIO user ".$_SESSION['fio_user'];
        echo "<br> Role ";
        var_dump($_SESSION['role_user']);


?>

