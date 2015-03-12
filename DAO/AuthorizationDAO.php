<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
class AuthorizationDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function getIdUser(MAuthorization $auth){
        $query="SELECT id_user FROM alluser WHERE login=$1 and password=$2;"; 
        $array_params=array();
        $array_params[]=$auth->getLogin();
        $array_params[]=$auth->getPassword();      
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data->id_user;
    }
    public function getAuthUser(MAuthorization $auth){
        if ($this->getIdUser($auth)){                 
            $this->log->info('Успешно введены логин и пароль пользователем '.$auth->getLogin());
            return $auth->getLogin();
        }
        else{ 
            $this->log->info('Неправильно введены логин и пароль пользователем '.$auth->getLogin());       
        }
     }
     public function getFIO(MAuthorization $auth){
         $query="select first_name, last_name, patronymic from alluser where id_user=$1;";
         $array_params=array();
        $array_params[]=$this->getIdUser($auth);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data;         
     }
     public function getRole(MAuthorization $auth){
         $query="select id_role from role_user where id_user=$1";
         $array_params=array();
        $array_params[]=$this->getIdUser($auth);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data->id_role; 
     }
}
?>
