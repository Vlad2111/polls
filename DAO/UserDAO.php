<?php
include_once 'lib/CheckOS.php';
include_once 'IntervieweeDAO.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'DAO/AdministrationDAO.php';
include_once 'model/MUser.php';
    Logger::configure(CheckOS::getConfigLogger());
class UserDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function createUser(MUser $user) {
        try {
            $query="INSERT INTO alluser(last_name, first_name, email, login, password, ldap_user)
                    VALUES ($1, $2, $3, $4, $5, $6);"; 
            $array_params=array();
            $array_params[]=$user->getLastName();
            $array_params[]=$user->getFirstName();
            $array_params[]=$user->getEmail();
            $array_params[]=$user->getLogin();
            $array_params[]=$user->getPassword();
            $array_params[]=$user->getLdapUser();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: alluser '.$e->getMessage().$e->getTraceAsString());
        }   
    }
    public function updateUser(MUser $user) {
        try {
            $query="UPDATE alluser SET last_name=$1, first_name=$2,"
                    . " email=$3, login=$4, ldap_user=$5"
                    . " where id_user=$6;";
            $array_params=array();
            $array_params[]=$user->getLastName();
            $array_params[]=$user->getFirstName();
            $array_params[]=$user->getEmail();
            $array_params[]=$user->getLogin();
            $array_params[]=$user->getLdapUser();
            $array_params[]=$user->getIdUser();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }         
    }
    public function deleteUser(MUser $user) {
        try {
            $query="DELETE FROM alluser WHERE id_user=$1;";
            $array_params=array();
            $array_params[]=$user->getIdUser();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function addRole(MUser $user) {
        try {
            $this->setIdUser($user);
            $array_roles=$user->getRoles();
            for($i=0; $i<count($array_roles); $i++){
                if($array_roles[$i]!=0){
                    $query="insert into role_user(id_role, id_user) values($1, $2);";
                    $array_params=array();
                    $array_params[]=$array_roles[$i];        
                    $array_params[]=$user->getIdUser();
                    $result=$this->db->executeAsync($query,$array_params);
                }           
            }
            return true;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: role_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function addFirstRole($idUser) {
        try {
            $query="insert into role_user(id_role, id_user) values(1, $1);";
            $array_params=array();       
            $array_params[]=$idUser;
            $result=$this->db->executeAsync($query,$array_params);
            return true;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: role_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function deleteRole(MUser $user) {
        try {
            $array_roles=$user->getRoles();
            for($i=0; $i<count($array_roles); $i++){
                $query="DELETE FROM role_user WHERE id_role=$1 and id_user=$2;";
                $array_params=array();        
                $array_params[]=$array_roles[$i];  
                $array_params[]=$user->getIdUser();
                $result=$this->db->executeAsync($query,$array_params);
            }
            return true;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: role_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function deleteAllRoleUser(MUser $user) {
        try {
            $temp_array=$this->getRolesUser($user->getIdUser());
            if($temp_array){
                for($i=0; $i<count($temp_array); $i++){
                    $query="DELETE FROM role_user WHERE id_user=$1;";
                    $array_params=array(); 
                    $array_params[]=$user->getIdUser();
                    $result=$this->db->executeAsync($query,$array_params);
                }            
            }
            else{
                return false;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: role_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getRolesUser($id_user) {
        try {
            $query="select id_role FROM role_user WHERE id_user=$1;";
            $array_params=array();          
            $array_params[]=$id_user;     
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: role_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function resetPassword(MUser $user) {
        try {
            $query="UPDATE alluser set password=$1 where id_user=$2;";
            $array_params=array();
            $array_params[]=$user->getPassword();
            $array_params[]=$user->getIdUser();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления пароля в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }      
    }
    public function setIdUser(MUser $user) {
        try {
            $query="select id_user from alluser where last_name=$1 and"
                    . " first_name=$2 and login=$3;";
            $array_params=array();
            $array_params[]=$user->getLastName();
            $array_params[]=$user->getFirstName();
            $array_params[]=$user->getLogin();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            $user->setIdUser($obj->id_user);
            return $obj->id_user;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения пароля в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        } 
    }        
    public function checkUserLDAP($login) {
        try {
            $query="select id_user from alluser where login=$1 and ldap_user=1;";
            $array_params=array();
            $array_params[]=$login;
            $result=$this->db->executeAsync($query,$array_params);
            $data=$this->db->getFetchObject($result);
            if($data){
                return $data->id_user;
            }
            else{
                return false;
            }      
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }   
    }   
    public function checkEmailUser($email) {
        try {
            $query="select id_user from alluser where email=$1;";
            $array_params=array();
            $array_params[]=$email;
            $result_query=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result_query);
            if(isset($obj->id_user)){
                return $obj->id_user;
            } else {
                return null;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function checkLoginUser($login) {
        try {
            $query="select id_user from alluser where login=$1;";
            $array_params=array();
            $array_params[]=$login;
            $result_query=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result_query);
            if(isset($obj->id_user)) {
                return $obj->id_user;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function searchUser($name) {
        try {
            $adm = new AdministrationDAO();
            $query = "select id_user from alluser where ldap_user=0 and (login like '%".strtolower($name)."%' OR login like '%".strtoupper($name)."%')";
            $array_params=array();
            $result=$this->db->executeAsync($query);
            $arr = $this->db->getArrayData($result);
            $array_result=array();
            for($i=0; $i<count($arr); $i++){
                if(isset($arr[$i])){
                    $array_result[$i]=$adm->getObjDataUser($arr[$i]);
                }
            }
            return $array_result;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getUserById($id_user) {
        try {
            $query="select last_name, first_name, email from alluser where id_user=$1;";
            $array_params=array();          
            $array_params[]=$id_user;     
            $result=$this->db->executeAsync($query,$array_params);
            $obj = $this->db->getFetchObject($result);
            $muser = new MUser();
            $muser->setLastName($obj->last_name);
            $muser->setFirstName($obj->first_name);
            $muser->setEmail($obj->email);
            return $muser;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных в таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }
    }
}
?>
