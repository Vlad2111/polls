<?php
include_once 'lib/CheckOS.php';
include_once 'IntervieweeDAO.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'DAO/AdministrationDAO.php';
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
                . " email=$3, login=$4, ldap_user=$5"
                . " where id_user=$6;";
        $array_params=array();
        $array_params[]=$user->getLastName();
        $array_params[]=$user->getFirstName();
        $array_params[]=$user->getEmail();
        $array_params[]=$user->getLogin();
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
        $temp_array=$this->getRolesUser($user->getIdUser());
        if($temp_array){
            for($i=0; $i<count($temp_array); $i++){
                $query="DELETE FROM role_user WHERE id_user=$1;";
                $array_params=array(); 
                //$array_params[]=$temp_array[$i];
                $array_params[]=$user->getIdUser();
                $result=$this->db->execute($query,$array_params);
                if(!$result){
                    $this->log->ERROR('Ошибка удаления строки в таблице: role_user( '.pg_last_error().')');  
        //                throw new Exception('Ошибка удаления строки в таблицу: role_user( '.pg_last_error().')');  
                }
            }            
        }
        else{
            return false;
        }
        
    }
    public function getRolesUser($id_user){
        $query="select id_role FROM role_user WHERE id_user=$1;";
        $array_params=array();          
        $array_params[]=$id_user;     
        $result=$this->db->execute($query,$array_params);
        return $this->db->getArrayData($result);
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
    public function checkEmailUser($email){
           $query="select id_user from alluser where email=$1;";
           $array_params=array();
           $array_params[]=$email;
           $result_query=$this->db->execute($query, $array_params);
           $obj=$this->db->getFetchObject($result_query);
           if(isset($obj->id_user)){
            return $obj->id_user;
           } else {
            return null;
           }
       }
    public function checkLoginUser($login){
           $query="select id_user from alluser where login=$1;";
           $array_params=array();
           $array_params[]=$login;
           $result_query=$this->db->execute($query, $array_params);
           $obj=$this->db->getFetchObject($result_query);
           if(isset($obj->id_user)) {
                return $obj->id_user;
           }
    }
    public function searchUser($name){
		$adm = new AdministrationDAO();
        $query = "select id_user from alluser where ldap_user=0 and (login like '%".strtolower($name)."%' OR login like '%".strtoupper($name)."%')";
		$array_params=array();
        //$array_params[]=$name;
        $result=$this->db->execute($query);
		$arr = $this->db->getArrayData($result);
		$array_result=array();
        for($i=0; $i<count($arr); $i++){
            if(isset($arr[$i])){
                $array_result[$i]=$adm->getObjDataUser($arr[$i]);
            }
        }
        return $array_result;
    }
	
}
?>

