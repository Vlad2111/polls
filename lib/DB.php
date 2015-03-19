<?php   
    include_once 'CheckOS.php';
    include_once 'Log4php/Logger.php';
        Logger::configure(CheckOS::getConfigLogger());
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
    	    
    	private function setConnectDb() { // Установка соединения с базой данных. 
            $array_ini= $this->getConfig ();
            $host = $array_ini['host'];
            $port = $array_ini['port'];
            $dbname = $array_ini['dbname'];
            $user = $array_ini['user'];
            $password_db = $array_ini['password_db'];
            $connect="host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$password_db; 
            $temp= pg_pconnect($connect);
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
            return @pg_query_params($this->db, $query, $array_params);
            //@-блокируем системные ошибки, чтобы срабатывали мои исключения            
        }        
        public function getFetchObject($result, $row=0){
            $featch_object=@pg_fetch_object($result, $row); 
            return $featch_object;   
        }
        public function getArrayData($result, $field=0){
            $array=array();
            for ($i=0; $i<pg_num_rows($result); $i++){
                $array[]=pg_fetch_result($result, $i, $field);
            }
            return $array;
        }
                        
        public function getConfig ($section='PostgreSQL'){
        $array= parse_ini_file(CheckOS::getConfigConnectDb(), true);
        return $array[$section];
        }        
        
    }    
    
                            
?>
