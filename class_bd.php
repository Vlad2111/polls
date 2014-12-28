<?php   
    class BD {
    	protected $host;
        protected $port;
        protected $dbname;
        protected $user;
        protected $password_bd;
    	private $db;    				
        
       public function __construct() { //Вставляем данные из конфиг. файла
            include_once 'class_work_with_conf.php';
            $pa= new work_with_conf("PostgreSQL");
           $pa->open_conf();
            $this->host = $pa->host;
            $this->port = $pa->port;
            $this->dbname = $pa->dbname;
            $this->user = $pa->user;
            $this->password_bd = $pa->password_bd;
        }
    	public function __get($name){ // Отображаем значение атрибутов
            return $this->$name;
    	}

    	private function connect_db() { // Установка соединения с базой данных
            $connect="host=".$this->host." port=".$this->port." dbname=".$this->dbname." user=".$this->user." password=".$this->password_bd;
            $this->db = pg_connect($connect);
            pg_set_client_encoding($this->db, "UTF-8"); 
					}

	public function query_db($q){	// Запрос к БД
            $this->connect_db();
            return @pg_query($this->db,$q);
	}

	public function check_query($qu){ // Проверка запроса, возвращает bool значение 
            $this->connect_db();
            $query=$this->query_db($qu);
            $t=@pg_num_rows($query);
            if ($t>0) return true;
            else return 0;
        }
        
        public function fetch_result($query, $row=0, $field=0){ //Возращает одиночные данные
            $this->connect_db();
            $result=$this->query_db($query);
            return pg_fetch_result($result, $row, $field);
        }
        
        public function result_array($table_name, $delimiter="\t"){ //Возрает табличные данные в виде двухмерного массива
            $this->connect_db();
            $array_rows= pg_copy_to($this->db, $table_name);
            $col_array= count($array_rows);
            for($i=0; $i<$col_array; $i++){
                $rows[$i]=  explode("\t", $array_rows[$i]);
            }
            return $rows;
        }
        /*
        public function result_attribute ($qu){ //Возращает результат запроса в виде ассоциатипного массива
            $this->connect_db();
            $result=$this->query_db($qu);
            if (@pg_num_rows($result)==1) {$count_attribute= pg_num_fields($result);
             return pg_fetch_assoc($result);}
            else return false;         
            
        }*/
                                
    }
?>