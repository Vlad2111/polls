<?php
class auth {
    public $login;
    public $pass;
    public $db;
    public function __construct($login, $pass) {
        $this->login= $this->correct($login);
        $this->pass=  $this->correct($pass);
        $re= new BD();
        $this->db =$re->connect_db();        
    }
    
    public function check_user(){
        $qu_check="select name, password from auth where name='".$this->login."' and password='".$this->pass."'";
       return BD::check_query($this->db,$qu_check);                        
    }
    
    public function correct ($value){
        return addslashes(trim($value)); //Удаляем пробелы перед и после строки. Экранируем сисмволы,
    }
    public function id_user(){ //Возращаем id пользователя
        $qu_id="select id_user from auth where name='".$this->login."' and password=".$this->pass.";";
        return  BD::fetch_result($this->db, $qu_id);                                                                              
    }
                                    
    public function auth_user(){ //Возращает значение пользователя или 
        if ($this->check_user()){self::Logging('Успешно введены логин и пароль пользователем '.$this->login);  return $this->id_user (); }else{ self::Logging('Успешно введены логин и пароль');    throw new Exception('Неправильно введены логин и пароль');}
    }
    public static function Logging($name){
            $foo= new AddLog();
        $foo->info($name);
        }
}
?>