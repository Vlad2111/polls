<?php
include_once 'DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
    LoggerNDC::push("Some Context");
class Administration{
    public $id_admin;
    public $db;
    public $log;
    
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
        $this->id_admin=$id_admin;
    }
    
    public function addUser($array_values){ 
        $str_values="nextval('id'),";
        for($i=0; $i<count($array_values);$i++){//составляем строку из значений для запроса
            if($i==count($array_values)-1){
                $str_values.="'$array_values[$i]'";
                break;                
            }
            $str_values.="'$array_values[$i]', ";    
        }
        $this->db->insertDb("alluser", $str_values);        
        $this->log->info('Добавлен новый пользователь '.$array_values[5]);
    }    
    public function editUser($id_user,$array_name, $array_values, $id_role=null){
        $query="$array_name[0]='$array_values[0]', $array_name[1]='$array_values[1]',"
                . "$array_name[2]='$array_values[2]', $array_name[3]='$array_values[3]',"
                . "$array_name[4]='$array_values[4]', $array_name[5]='$array_values[5]',"
                . "$array_name[6]='$array_values[6]' where id_user=$id_user;";
        $this->db->updateDb('alluser', $query);
        if($id_role!=null){
            $this->editRole($id_user, $id_role);
        }
    }
    public function deleteUser($id_user){
        $query="id_user=$id_user";
        $this->db->deleteDb('alluser', $query); 
        $this->deleteRole($id_user);
    }
    public function addRole($id_user, $id_role){
        $str_values="$id_user, $id_role";
        $this->db->insertDb("role_user", $str_values);
    }
    public function editRole($id_user, $id_role){
        $query="id_role=$id_role where id_user=$id_user;";
        $this->db->updateDb('role_user', $query);
    }
    public function deleteRole($id_user){
        $query="id_user=$id_user";
        $this->db->deleteDb('role_user', $query);         
    }    
}       
?>