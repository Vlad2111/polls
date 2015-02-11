<?php
include_once 'lib/DB.php';
include_once 'model/ValuesAdministration.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
class AdministrationDAO {
   private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createUser($admin){
        $query="INSERT INTO alluser(last_name, first_name, patronymic, type, email, login, password)
                VALUES ($1, $2, $3, $4, $5, $6, $7);"; 
        $array_params=array();
        $array_params[]=$admin->getLastName();
        $array_params[]=$admin->getFirstName();
        $array_params[]=$admin->getPatronymic;
        $array_params[]=$admin->getType();
        $array_params[]=$admin->getEmail();
        $array_params[]=$admin->getLogin();
        $array_params[]=$admin->getPassword();       
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: alluser( '.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: alluser( '.pg_last_error().')');  
        }   
    }
    public function updateUser($admin){
        $query="UPDATE alluser SET last_name=$1, first_name=$2,"
                . " patronymic=$3, type=$4,"
                . " email=$5, login=$6,  password=$7"
                . " where id_user=$8;";
        $array_params=array();
        $array_params[]=$admin->getLastName();
        $array_params[]=$admin->getFirstName();
        $array_params[]=$admin->getPatronymic;
        $array_params[]=$admin->getType();
        $array_params[]=$admin->getEmail();
        $array_params[]=$admin->getLogin();
        $array_params[]=$admin->getPassword();       
        $array_params[]=$admin->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: alluser( '.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: alluser( '.pg_last_error().')');  
        }          
    }
    public function deleteUser($admin){
        $query="DELETE FROM alluser WHERE id_user=$1;";
        $array_params=array();
        $array_params[]=$admin->getIdUser();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')');  
            throw new Exception('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')'); 
        }  
    }
    public function addRole($admin){
        $query="insert into role_user values($1, $2);";
        $array_params=array();
        $array_params[]=$admin->getIdUser();
        $array_params[]=$admin->getIdRole();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: role_user( '.pg_last_error().')');  
            throw new Exception('Ошибка добавления строки в таблицу: role_user( '.pg_last_error().')');  
        }          
    }
    public function deleteRole($admin){
        $query="DELETE FROM role_user WHERE id_user=$1 and id_role=$2);";
        $array_params=array();
        $array_params[]=$admin->getIdUser();
        $array_params[]=$admin->getIdRole();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблицу: role_user( '.pg_last_error().')');  
            throw new Exception('Ошибка удаления строки в таблицу: role_user( '.pg_last_error().')');  
        }  
    }
    public function resetPassword($admin){
        $query="UPDATE alluser set password=$1 where id_user=$2;";
        $array_params=array();
        $array_params[]=$admin->getPassword();
        $array_params[]=$admin->getIdUser();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка обновления пароля в таблице: alluser( '.pg_last_error().')'); 
            throw new Exception('Ошибка обновления пароля в таблице: alluser( '.pg_last_error().')'); 
        } 
    }
}
?>
