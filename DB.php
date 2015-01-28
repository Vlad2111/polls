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
                $this->log->info('Ошибка соединения с БД');
                throw new Exception('Ошибка соединения с БД');
            }
        }
        public function getQueryDb($name_colums, $name_table, $query, $array_params){    // Запрос к БД                             
            $select="SELECT ".$name_colums." FROM ".$name_table." where ".$query;
            $query= @pg_query_params($select, $array_params);
            if ($query){
                return $query;                
            }
            else{ 
                $this->log->info('Ошибка в запросе к бд'); 
                throw new Exception('Ошибка в запросе к бд');                     
            }            
        }
        public function insertDb($name_table, $str, $name_colums=null){            
            if ($name_colums==null){
                $select="INSERT INTO ".$name_table." VALUES (".$str.");";                
            }
            else{
                $select="INSERT INTO ".$name_table." (".$name_colums.") VALUES (".$str.");";
            }
           if(!@pg_query($select)){
                $this->log->info('Ошибка добавления строки в таблицу: '.$name_table); 
                throw new Exception('Ошибка добавления строки в таблицу: '.$name_table);
           }    
        }
        
        public function updateDb($name_table, $query){
            $select="UPDATE ".$name_table." SET ".$query;
             if(!@pg_query($select)){
                 $this->log->info('Ошибка обновления строки в таблице: '.$name_table); 
                throw new Exception('Ошибка обновления строки в таблице: '.$name_table);  
            }            
        }
        public function deleteDb($name_table, $query){
            $select="DELETE FROM ".$name_table." WHERE ".$query.";";
             if(!@pg_query($select)){
                 $this->log->info('Ошибка удаления строки в таблице: '.$name_table); 
                throw new Exception('Ошибка удаления строки в таблице: '.$name_table);  
            }            
        }
        public function getFetchResult($query, $row=0, $field=0){ //Возращает одиночные данные
            $tamp_var_featch_result=@pg_fetch_result($query, $row, $field);
            if($tamp_var_featch_result){ 
                return $tamp_var_featch_result;                
            }
            else{
                $this->log->info('Ошибка в возращении записи из результата запроса'); 
                throw new Exception('Ошибка в возращении записи из результата запроса'); 
            }
        }
                        
        public function getConfig ($section='PostgreSQL', $path="setting/config_dike.ini"){
        $array= parse_ini_file($path, true);
        return $array[$section];
        }        
        
    }    
    
                            
?>
