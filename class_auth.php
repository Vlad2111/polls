<?php
include 'Logging.php';
class auth {
    public $login;
    public $pass;
    public $db;
    public function __construct($login, $pass) {
        $this->login= $this->correct($login);
        $this->pass=  $this->correct($pass);
        $this->getDB();
    }
    
    public function check_user(){
        $array_params[0]='login';
        $array_params[1]=$this->login;
        $array_params[2]='password';
        $array_params[3]=$this->$this->pass;
        $qu_check=BD::query_db($this->db,'alluser','login, password',$array_params);
       return DB::check_query($qu_check);                        
    }
    
    public function correct ($value){
        return addslashes(trim($value)); //Удаляем пробелы перед и после строки. Экранируем сисмволы,
    }
    public function get_id_user(){ //Возращаем id пользователя
        $qu_id="select id_user from alluser where name='".$this->login."' and password=".$this->pass.";";
        return  DB::fetch_result($this->db, $qu_id);                                                                              
    }
                                    
    public function get_auth_user(){ //Возращает значение пользователя или 
        if ($this->check_user()){self::Logging('Успешно введены логин и пароль пользователем '.$this->login);  return $this->id_user (); }else{ self::Logging('Успешно введены логин и пароль');    throw new Exception('Неправильно введены логин и пароль');}
    }
    public static function Logging($name){
            $foo= new AddLog();
        $foo->info($name);
        }
    public function getDB(){
        $re= new DB();
        $this->db =$re->connect_db();      
    }
}
?>