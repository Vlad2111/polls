<?php
/**
 * Возвращает расположения файлов в зависимости от OS
 *
 * @author Aleksey Porandaykin
 */
class CheckOS {
   public static function getConfigLogger(){
       switch (PHP_OS) {
           case 'Linux': 
               $config_path='/etc/config_log4php_dev.xml';
               break;
       }
       return $config_path;
   }
   public static function getConfigConnectDb(){
       switch (PHP_OS) {
           case 'Linux': 
               $config_path="/etc/config_dike_dev.ini";
               break;
       }
       return $config_path;
   }
   public static function getConfigRole(){
       switch (PHP_OS) {
           case 'Linux': 
               $config_path="/etc/role_dike_dev.ini";
               break;
       }
       return $config_path;
   }
}
?>
