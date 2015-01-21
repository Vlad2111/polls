<?php


include_once 'Logging.php';
class Error{
    public static function Add($a, $b){
        AddLog::Logging($a,$b);
        throw new Exception($b); 
    }
    
}
?>