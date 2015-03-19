<?php
class CheckOS {
   public static function getConfigLogger(){
       switch (PHP_OS) {
           case 'WINNT':
               $config_path= 'setting/config.xml';               
               break;
           case 'Linux': 
               $config_path='/etc/config_log4php.xml';
               break;
       }
       return $config_path;
   }
   public static function getConfigConnectDb(){
       switch (PHP_OS) {
           case 'WINNT':
               $config_path= "setting/config_dike.ini";               
               break;
           case 'Linux': 
               $config_path="/etc/config_dike.ini";
               break;
       }
       return $config_path;
   }
}
