<?php
    $to= "<".$_POST['to'].">";

    $subject = $_POST['subject'];

    $message = $_POST['message'];

    $headers= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $headers .= "From: <".$_POST['from'].">\r\n";
    $var = mail($to, $subject, $message, $headers);
    echo $var;
