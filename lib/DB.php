<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author Aleksey Porandaykin
 */
include_once 'CheckOS.php';
include_once 'ConfigFile.php';
include_once 'log4php/Logger.php';
        Logger::configure(CheckOS::getConfigLogger());
    class DB {
        protected static $_instance;
        private $db;
        private $log;
        public static function getInstance() { // получить экземпляр данного класса 
            if (self::$_instance === null) { // если экземпляр данного класса  не создан
                self::$_instance = new self;  // создаем экземпляр данного класса 
            } 
            return self::$_instance; // возвращаем экземпляр данного класса
        }
        
        private function __construct() { //Вставляем данные из конфиг. файла            
            $this->db= $this->setConnectDb();
            $this->log= Logger::getLogger(__CLASS__);            
        }
    	    
    	private function setConnectDb() { // Установка соединения с базой данных. 
            $config_file = ConfigFile::getInstance();
            $array_ini = $config_file->array_params['PostgreSQL'];
            $host = $array_ini['host'];
            $port = $array_ini['port'];
            $dbname = $array_ini['dbname'];
            $user = $array_ini['user'];
            $password_db = $array_ini['password_db'];
            $connect="host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$password_db; 
            $temp= pg_connect($connect);
            if($temp){
                pg_set_client_encoding($temp, "UTF-8");
                return $temp;
            } 
            else{   
                $this->log->ERROR('Ошибка соединения с БД( '.pg_last_error().')');
                throw new Exception('Ошибка соединения с БД( '.pg_last_error().')');
            }
        }
        public function execute($query, $array_params=null){
            if($array_params==null){
                $result= pg_query($this->db, $query);
                return $result;
            }
            else{
                $result= pg_query_params($this->db, $query, $array_params);   
                return $result;
            }           
                 
        }        
        /* 
        *   request to db
        */
        public function executeAsync($query, $array_params=null){
            if($array_params==null){
                pg_send_query($this->db, $query);
            }
            else{
                pg_send_query_params($this->db, $query, $array_params); 
            } 
            $return = pg_get_result($this->db);
            $error = pg_result_error($return);
            if($error != '' || $error != false)
                throw new Exception($error);
            else return $return;
        }        
        
        public function getFetchObject($resource_query, $row=0){            
            if(pg_num_rows($resource_query)>0){
                return pg_fetch_object($resource_query, $row);
            }
            else{
                return false;
            }
        }
        public function getArrayData($resource_query, $field=0){
            if(pg_num_rows($resource_query)>0){
                $array=array();
            for ($i=0; $i<pg_num_rows($resource_query); $i++){
                $array[]=pg_fetch_result($resource_query, $i, $field);
            }
            return $array;
            }
            else{
                return false;
            }
        }
                        
//        public function getConfig ($section= 'PostgreSQL'){
//        $array= parse_ini_file(CheckOS::getConfigConnectDb(), true);
//        return $array[$section];
//        }        
        
    }
