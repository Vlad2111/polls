<?php
    include_once 'class_db.php';
    include_once 'Log4php/Logger.php';
        Logger::configure('config.xml');
        LoggerNDC::push("Some Context");
    class Auth {
        private $login;
        private $pass;
        private $db;
        private $log;
        public function __construct($login, $pass) {
            $this->db=DB::getInstance();
            $this->log= Logger::getLogger(__CLASS__);
            $this->login= pg_escape_string($login);
            $this->pass=  md5($pass);
        }    
       
        public function getIdUser(){ //Возращаем id пользователя
            $array_params[0]=$this->login;
            $array_params[1]=$this->pass;
            $query=$this->db->getQueryDb('id_user', 'alluser', "login=$1 and password=$2", $array_params);
            return  $this->db->getFetchResult($query);                                                                              
        }
                                    
        public function getAuthUser(){ //Возращает значение пользователя или 
            if ($this->getIdUser())
            {
                $this->log->info('Успешно введены логин и пароль пользователем '.$this->login);
                return $this->getIdUser ();
            }
            else{ 
                $this->log->info('Неправильно введены логин и пароль');
                throw new Exception('Неправильно введены логин и пароль');              
            }
        }
   
    }
?>