<?php
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
?>