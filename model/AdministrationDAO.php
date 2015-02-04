<?php
include_once 'lib/DB.php';
include_once 'ValuesAdministration.php';
include_once 'Log4php/Logger.php';
class AdministrationDAO {
   private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createUser($admin){
        $query="INSERT INTO alluser(id_user, last_name, first_name, patronymic, type, email, login, password)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8);"; 
        $array_params[]="'$admin->id_user'";
        $array_params[]="'$admin->last_name'";
        $array_params[]="'$admin->first_name'";
        $array_params[]="'$admin->patronymic'";
        $array_params[]="'$admin->type'";
        $array_params[]="'$admin->email'";
        $array_params[]="'$admin->login'";
        $array_params[]="'$admin->password'";       
        
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка добавления строки в таблицу: alluser'); 
            throw new Exception('Ошибка добавления строки в таблицу: alluser'); 
        }   
    }
    public function updateUser($admin){
        $query="UPDATE alluser SET last_name='$2', first_name='$3',"
                . " patronymic='$4', type='$5',"
                . " email='$6', login='$7',  password='$8'"
                . " where id_user='$1';";
        $array_params= array('$admin->id_user', '$admin->last_name', '$admin->first_name', '$admin->patronymic', 
                '$admin->type', '$admin->email', '$admin->login', '$admin->password');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка обновления строки в таблице: alluser'); 
            throw new Exception('Ошибка обновления строки в таблице: alluser'); 
        }          
    }
    public function deleteUser($admin){
        $query="DELETE FROM alluser WHERE id_user='$admin->id_user';";
        if(!$this->db->execute($query)){
            $this->log->ERROR('Ошибка удаления строки в таблице: alluser'); 
            throw new Exception('Ошибка удаления строки в таблице: alluser'); 
        }  
    }
    public function addRole($admin){
        $query="insert into role_user values($1, $2);";
          $array_params=array('$admin->id_user','$admin->id_role');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка добавления строки в таблицу: role_user'); 
            throw new Exception('Ошибка добавления строки в таблицу: role_user'); 
        }          
    }
    public function deleteRole($admin){
         $query="DELETE FROM role_user WHERE id_user=$1 and id_role=$2);";
          $array_params=array('$admin->id_user','$admin->id_role');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка удаления строки в таблицу: role_user'); 
            throw new Exception('Ошибка удаления строки в таблицу: role_user'); 
        }  
    }
    public function resetPassword($admin){
        $hash_password=  md5($admin->password);
        $query="UPDATE alluser set password='$hash_password' where id_user=$admin->id_user;";
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка обновления пароля в таблице: alluser'); 
            throw new Exception('Ошибка обновления пароля в таблице: alluser'); 
        } 
    }
}
?>
