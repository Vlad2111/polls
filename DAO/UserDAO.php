<?php
include_once 'lib/CheckOS.php';
include_once 'IntervieweeDAO.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure(CheckOS::getConfigLogger());
class UserDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function createUser(MUser $user){
        $query="INSERT INTO alluser(last_name, first_name, email, login, password, ldap_user)
                VALUES ($1, $2, $3, $4, $5, $6);"; 
        $array_params=array();
        $array_params[]=$user->getLastName();
        $array_params[]=$user->getFirstName();
        $array_params[]=$user->getEmail();
        $array_params[]=$user->getLogin();
        $array_params[]=$user->getPassword();
        $array_params[]=$user->getLdapUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: alluser( '.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблицу: alluser( '.pg_last_error().')');  
        }   
    }
    public function updateUser(MUser $user){
        $query="UPDATE alluser SET last_name=$1, first_name=$2,"
                . " email=$3, login=$4,  password=$5, ldap_user=$6"
                . " where id_user=$7;";
        $array_params=array();
        $array_params[]=$user->getLastName();
        $array_params[]=$user->getFirstName();
        $array_params[]=$user->getEmail();
        $array_params[]=$user->getLogin();
        $array_params[]=$user->getPassword(); 
        $array_params[]=$user->getLdapUser();
        $array_params[]=$user->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: alluser( '.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: alluser( '.pg_last_error().')');  
        }          
    }
    public function deleteUser(MUser $user){
        $query="DELETE FROM alluser WHERE id_user=$1;";
        $array_params=array();
        $array_params[]=$user->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')');  
//            throw new Exception('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')'); 
        }  
    }
    public function addRole(MUser $user){
        $this->setIdUser($user);
        $array_roles=$user->getRoles();
        for($i=0; $i<count($array_roles); $i++){
            if($array_roles[$i]!=0){
                $query="insert into role_user(id_role, id_user) values($1, $2);";
                $array_params=array();
                $array_params[]=$array_roles[$i];        
                $array_params[]=$user->getIdUser();
                $result=$this->db->execute($query,$array_params);
                if(!$result){
                    $this->log->ERROR('Ошибка добавления строки в таблицу: role_user( '.pg_last_error().')');  
    //              throw new Exception('Ошибка добавления строки в таблицу: role_user( '.pg_last_error().')');
                }
            }           
        }
        return true;
    }
    public function deleteRole(MUser $user){
        $array_roles=$user->getRoles();
        for($i=0; $i<count($array_roles); $i++){
            $query="DELETE FROM role_user WHERE id_role=$1 and id_user=$2;";
            $array_params=array();        
            $array_params[]=$array_roles[$i];  
            $array_params[]=$user->getIdUser();
            $result=$this->db->execute($query,$array_params);
            if(!$result){
                $this->log->ERROR('Ошибка удаления строки в таблице: role_user( '.pg_last_error().')');  
//                throw new Exception('Ошибка удаления строки в таблицу: role_user( '.pg_last_error().')');  
            }
        }
        return true;
    }
    public function deleteAllRoleUser(MUser $user){
        $query="DELETE FROM role_user WHERE id_user=$1;";
        $array_params=array();          
        $array_params[]=$user->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if(!$result){
            $this->log->ERROR('Ошибка удаления строки в таблице: role_user( '.pg_last_error().')');  
//                throw new Exception('Ошибка удаления строки в таблицу: role_user( '.pg_last_error().')');  
        }
    }
    public function resetPassword(MUser $user){
        $query="UPDATE alluser set password=$1 where id_user=$2;";
        $array_params=array();
        $array_params[]=$user->getPassword();
        $array_params[]=$user->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка обновления пароля в таблице: alluser( '.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления пароля в таблице: alluser( '.pg_last_error().')'); 
        }        
    }
    public function setIdUser(MUser $user){
        $query="select id_user from alluser where last_name=$1 and"
                . " first_name=$2 and login=$3;";
        $array_params=array();
        $array_params[]=$user->getLastName();
        $array_params[]=$user->getFirstName();
        $array_params[]=$user->getLogin();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $user->setIdUser($obj->id_user);
        return $obj->id_user;
        }        
    public function checkUserLDAP($login){
        $query="select id_user from alluser where login=$1 and ldap_user=1;";
        $array_params=array();
        $array_params[]=$login;
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        if($data){
            return $data->id_user;
        }
        else{
            return false;
        }
        
    }    
}
?>
