<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
			<?php   
                            class BD {
    				protected $host='localhost';
                                protected $port='5432';
                                protected $dbname='dike';
                                protected $user='postgres';
                                protected $password_bd='1';
    				private $db;    				

    				public function __get($name){ // Отображаем значение атрибутов
    					return $this->$name;
    				}

    				private function connect_db() { // Установка соединения с базой данных
    					$connect="host=".$this->host." port=".$this->port." dbname=".$this->dbname." user=".$this->user." password=".$this->password_bd;
       					$this->db = pg_connect($connect);
        				pg_set_client_encoding($this->db, "UTF-8"); 
					}

				private function query_db($q){	// Запрос к БД
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
                                public function fetch_result($query, $row=0, $field=0){
                                    $this->connect_db();
                                    $result=$this->query_db($query);
                                    return pg_fetch_result($result, $row, $field);
                                }
                                
                            }
                                class auth {
                                    public $login;
                                    public $pass;
                                    public function __construct($login, $pass) {
                                        $l= $this->correct($login);
                                        $p=$this->correct($pass);
                                        $this->login=$l;
                                        $this->pass=$p;                                                
                                    }
                                    public function check_user(){
                                        $qu_check="select name, password from auth where name='".$this->login."' and password='".$this->pass."'";
                                        $db_check= new BD();
                                        if  ($db_check->check_query($qu_check)) return true; else return false;                        
                                    }
                                    public function correct ($value){
                                        return addslashes(trim($value)); //Удаляем пробелы перед и после строки. Экранируем сисмволы,
                                    }
                                    public function id_user(){ //Возращаем id пользователя
                                       $qu_id="select id_user from auth where name='".$this->login."' and password='".$this->pass."'";
                                       $db_id= new BD();
                                       return $db_id->fetch_result($qu_id);                                                                              
                                    }
                                    
                                    public function auth_user(){ //Возращает значение пользователя или 
                                        if ($this->check_user()) return $this->id_user (); else return false;
                                    }
                                }
                                
                                class admin{
                                    protected $value_admin='all';
                                    public function users (){
                                        $qu="";
                                    }
                                    
                                }
                            $qw=new auth('Стас', 3);
                            echo $qw->auth_user();   
                            
                            echo "<br>";
                            $re= new BD();
                            echo $re->user;
                        ?>
		</body>
</html>