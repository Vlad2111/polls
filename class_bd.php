<?php   
    include_once 'Log4php/Logger.php';
Logger::configure('config.xml');
LoggerNDC::push("Some Context");
    class BD {
    	private $host;
        private $port;
        private $dbname;
        private $user;
        private $password_bd;
    	private $db;
        
        public function __construct($host='localhost',
                                    $port='5432',
                                    $dbname='dike',
                                    $user='postgres',
                                    $password_bd='1') {
            $this->host=$host;
            $this->port=$port;
            $this->dbname=$dbname;
            $this->user=$user;
            $this->password_bd=$password_bd;
        }
    	public function __get($name){ // Отображаем значение атрибутов
            return $this->$name;
    	}
        
        public function setConnectDB(){
            $this->db=  self::connect_db;
        }
        
        public function getHost(){
            return $this->host;
        }        
        public function getPort(){
            return $this->port;
        }
        public function getDBname(){
            return $this->dbname;
        }
        public function getUser(){
            return $this->user;
        }
        public function getPasswordDB(){
            return $this->password_bd;
        }
        
        public function setDB(){
            $this->db= $this->connect_db();
        }        
              
    	public function connect_db() { // Установка соединения с базой данных
            $connect="host=".$this->host." port=".
                    $this->port." dbname=".$this->dbname." user=".$this->user." password=".$this->password_bd;            
             if(@pg_connect($connect)) {
                 $temp= pg_connect($connect);
                 pg_set_client_encoding($temp, "UTF-8");                 
                 return $temp;
             }
                else    throw new Exception('Ошибка соединения с БД');
        }
        
        public static function query_db($db,$q){	// Запрос к БД            
            if(@pg_query($db,$q)){
                               return pg_query($db,$q);}
            else throw new Exception('Ошибка в запросе к бд');
            
	}

	public static function check_query($db,$qu){ // Проверка запроса, возвращает bool значение 
            $query=  self::query_db($db,$qu);
            $t=pg_num_rows($query);
            if ($t>0) return true;
            else return 0;
        }
        
        public static function fetch_result($db,$query, $row=0, $field=0){ //Возращает одиночные данные
            $result=  self::query_db($db,$query);
            if(@pg_fetch_result($result, $row, $field)){ return pg_fetch_result($result, $row, $field);}
                else throw new Exception('Ошибка в возращении записи из результата запроса');
        }
        
        public static function result_array($db,$table_name, $delimiter="\t"){ //Возрает табличные данные в виде двухмерного массива
            if (@pg_copy_to($db, $table_name)) $array_rows= pg_copy_to($db, $table_name);
                else throw new Exception('Копирование данные из таблицы в массив произошло с ошибкой');
            $col_array= count($array_rows);
            for($i=0; $i<$col_array; $i++){
                $rows[$i]=  explode("\t", $array_rows[$i]);
            }
            return $rows;
        }
        
        public static function Logging($name){
            $foo= new AddLog();
        $foo->info($name);
        }
                                       
    
    }
?>