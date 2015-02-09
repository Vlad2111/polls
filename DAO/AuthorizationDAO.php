<?php
include_once 'lib/DB.php';
include_once 'model/ValuesAuthorization.php';
include_once 'Log4php/Logger.php';
        Logger::configure('setting/config.xml');
class AuthorizationDAO {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function getIdUser($auth){
        $query="SELECT id_user FROM alluser WHERE login=$1 and password=$2;"; 
        $array_params=array();
        $array_params[]=$auth->getLogin();
        $array_params[]=$auth->getPassword();      
        $result=@$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data->id_user;
    }
    public function getAuthUser($auth){
        if ($this->getIdUser($auth)){                 
            $this->log->info('Успешно введены логин и пароль пользователем '.$auth->getLogin());
            return $auth->getLogin();
        }
        else{ 
            $this->log->info('Неправильно введены логин и пароль пользователем '.$auth->getLogin());
            //throw new Exception('Неправильно введены логин и пароль пользователем '.$auth->getLogin());            
        }
     }
}
?>
