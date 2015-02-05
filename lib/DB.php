<?php   
    include_once 'Log4php/Logger.php';
        Logger::configure('setting/config.xml');
        LoggerNDC::push("Some Context");
    class DB {
        protected static $_instance;  
        private  $db;
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
    	public function __get($name){ // Отображаем значение атрибутов
            return $this->$name;
    	}            
              
    	private function setConnectDb() { // Установка соединения с базой данных. 
            $array_ini= $this->getConfig ();
            $host = $array_ini['host'];
            $port = $array_ini['port'];
            $dbname = $array_ini['dbname'];
            $user = $array_ini['user'];
            $password_db = $array_ini['password_db'];
            $connect="host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$password_bd; 
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
//        public function getQueryDb($name_colums, $name_table, $query, $array_params){    // Запрос к БД                             
//            $select="SELECT ".$name_colums." FROM ".$name_table." where ".$query;
//            $query= @pg_query_params($select, $array_params);
//            if ($query){
//                return $query;                
//            }
//            else{ 
//                $this->log->ERROR('Ошибка в запросе к бд'); 
//                throw new Exception('Ошибка в запросе к бд');                     
//            }            
//        }       
        public function execute($query, $array_params){ 
               return pg_query_params($this->db, $query, $array_params);
                
        }        
        public function getFetchResult($query, $row=0, $field=0){ //Возращает одиночные данные
            $tamp_var_featch_result=@pg_fetch_result($query, $row, $field);
            if($tamp_var_featch_result){ 
                return $tamp_var_featch_result;                
            }
            else{
                $this->log->ERROR('Ошибка в возращении записи из результата запроса'); 
                throw new Exception('Ошибка в возращении записи из результата запроса'); 
            }
        }
                        
        public function getConfig ($section='PostgreSQL', $path="setting/config_dike.ini"){
        $array= parse_ini_file($path, true);
        return $array[$section];
        }        
        
    }    
    
                            
?>
