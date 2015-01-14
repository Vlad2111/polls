<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php   
    include_once 'Logging.php';
    class DB {
    	private $host;
        private $port;
        private $dbname;
        private $user;
        private $password_bd;
    	private $db;
        
       public function __construct() { //Вставляем данные из конфиг. файла
            $array_ini=$this->getConfig ();
            $this->host = $array_ini['host'];
            $this->port = $array_ini['port'];
            $this->dbname = $array_ini['dbname'];
            $this->user = $array_ini['user'];
            $this->password_db = $array_ini['password_db'];
        }
    	public function __get($name){ // Отображаем значение атрибутов
            return $this->$name;
    	}
        
        public function setConnectDB(){
            $this->db=  self::connect_db();
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
        public static function query_db($db, $name_colums, $name_table, $array_params){    // Запрос к БД  
            if(count($array_params)%2==0){
                $temp_var="";
                for($i=1; $i<=count($array_params);$i=$i+2){
                    $temp_var_a=$i;
                    $temp_var_b=$i+1;
                    $temp_var.="$".$temp_var_a."=$".$temp_var_b;
                        if($i+1!=count($array_params)){$temp_var.=" and ";}
                }                
                $select="SELECT ".$name_colums." FROM ".$name_table." where ".$temp_var;
                $query= pg_query_params($db, $select, $array_params);
                return $query;}
            else throw new Exception('Ошибка в запросе к бд'); 
            
        }

	public static function check_query($query){ // Проверка запроса, возвращает bool значение$query=self::query_db($db, $name_colums, $name_table, $array_params);
            $temp_var_check_query=pg_num_rows($query);
            if (temp_var_check_query>0) return true;
            else return 0;
        }
        
        public static function fetch_result($query, $row=0, $field=0){ //Возращает одиночные данные
            $tamp_var_featch_result=@pg_fetch_result($query, $row, $field);
            if($tamp_var_featch_result){ return $tamp_var_featch_result;}
                else throw new Exception('Ошибка в возращении записи из результата запроса');
        }
        
        public static function result_array($db,$table_name, $delimiter="\t"){ //Возрает табличные данные в виде двухмерного массива
            $temp_var_result_array=@pg_copy_to($db, $table_name);
            if ( $temp_var_result_array) $array_rows=  $temp_var_result_array;
                else throw new Exception('Копирование данные из таблицы в массив произошло с ошибкой');
            $col_array= count($array_rows);
            for($i=0; $i<$col_array; $i++){
                $rows[$i]=  explode("\t", $array_rows[$i]);
            }
            return $rows;
        }
        
        public function getConfig ($section='PostgreSQL', $path="config_dike.ini"){
        $array= parse_ini_file($path, true);
        return $array[$section];
        }
    }
    
                            
?>
</body>
</html>