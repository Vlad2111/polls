<?php
include_once 'class_db.php';
include_once 'for_class.php';
class auth {
    public $login;
    public $pass;
    public $db;
    public function __construct($login, $pass) {
        $this->login= $this->correct($login);
        $this->pass=  $this->correct($pass);
    }
    
    public function correct ($value){
        return pg_escape_string($value); //Экранирование спецсимволов в строке
    }
    public function getIdUser(){ //Возращаем id пользователя
        $array_params[0]=$this->login;
        $array_params[1]=$this->pass;
        $query=DB::getQuery_db('id_user', 'alluser', "login=$1 and password=$2", $array_params);
        return  DB::getFetch_result($query);                                                                              
    }
                                    
    public function getAuthUser(){ //Возращает значение пользователя или 
        if ($this->getIdUser()){
            $a=__CLASS__;
            AddLog::Logging($a,'Успешно введены логин и пароль пользователем '.$this->login);  
             return $this->getIdUser ();
        }
        else{ 
            self::Logging('Успешно введены логин и пароль');    
            throw new Exception('Неправильно введены логин и пароль');              
        }
    }
   
}
?>