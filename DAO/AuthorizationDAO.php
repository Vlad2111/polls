<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'lib/PhpLDAP.php';
include_once 'Log4php/Logger.php';
include_once 'model/MUser.php';
    Logger::configure(CheckOS::getConfigLogger());
class AuthorizationDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function checkUserDB(MAuthorization $auth){
        $query="SELECT id_user FROM alluser WHERE login=$1 and password=$2;"; 
        $array_params=array();
        $array_params[]=$auth->getLogin();
        $array_params[]=$auth->getPassword();      
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data->id_user;
    }
    public function checkUserLDAP(MAuthorization $auth){
        $ldap=new PhpLDAP();
        $ldap->checkUser($auth);
        if ($ldap->checkUser($auth)){
            $query="SELECT id_user FROM alluser WHERE login=$1;"; 
            $array_params=array();
            $array_params[]=$auth->getLogin();     
            $result=$this->db->execute($query,$array_params);
            $data=$this->db->getFetchObject($result);
            return $data->id_user;
        }
        else {
                return $ldap->checkUser($auth);                
        }
    }
    public function getIdUser(MAuthorization $auth, $param){
        if ($param=="database"){
            return $this->checkUserDB($auth);            
        }
        if ($param=="LDAP") {
            return $this->checkUserLDAP($auth);
        }
        else {
            return false;
        }
    }
    
    public function getAuthUser(MAuthorization $auth, $param){
        if ($this->getIdUser($auth, $param)){                 
            $this->log->info('Успешно введены логин и пароль пользователем '.$auth->getLogin());
            return $auth->getLogin();
        }
        else{ 
            $this->log->info('Неправильно введены логин и пароль пользователем '.$auth->getLogin());       
        }
     }     
     public function getObjUser(MAuthorization $auth, $param){
         $query="select * from alluser where id_user=$1;";
         $array_params=array();
        $array_params[]=$this->getIdUser($auth, $param);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        $muser=new MUser();
        $muser->setFirstName($data->first_name);
        $muser->setEmail($data->email);
        $muser->setIdRole($this->getRole($auth, $param));
        $muser->setIdUser($data->id_user);
        $muser->setLastName($data->last_name);
        $muser->setLogin($data->login);
//        $muser->setIdRole($this->getRole($auth));
        return $muser;         
     }
     public function getRole(MAuthorization $auth, $param){
         $query="select id_role from role_user where id_user=$1";
         $array_params=array();
        $array_params[]=$this->getIdUser($auth, $param);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        return $data->id_role; 
     }
}
?>
