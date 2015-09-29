<?php
    $to= "<".$_POST['to'].">";

    $subject = $_POST['subject'];

    $message = $_POST['message'];

    $headers= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    $headers .= "From: ".$_POST['lastname']." ".$_POST['name']." <".$_POST['from'].">\r\n";
    $var = mail($to, $subject, $message, $headers);
    echo $var;
