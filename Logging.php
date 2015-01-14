<?php

class AddLog
    {        
        private $log;
        public function __construct() {
        include_once 'Log4php/Logger.php';
        Logger::configure('config.xml');
        LoggerNDC::push("Some Context");
            $this->log = Logger::getLogger('myLogger');
        }
        public function Fatal($name){
            $this->log->fatal($name);
        }
        public function Error($name){
            $this->log->error($name);
        }
        public function Warn($name){
            $this->log->warn($name);
        }
        public function Info($name){
            $this->log->info($name);
        }
        public function Debug($name){
            $this->log->debug($name);
        }
         public static function Logging($name){
            $foo= new AddLog();
        $foo->info($name);
        }
    }
        ?>