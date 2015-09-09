<?php
include_once 'model/MUser.php';
include_once 'DAO/UserDAO.php';
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'lib/PhpLDAP.php';
include_once 'log4php/Logger.php';
include_once 'model/MUser.php';
include_once 'DAO/AdministrationDAO.php';
    Logger::configure(CheckOS::getConfigLogger());
class AuthorizationDAO {
    protected $db;
    protected $log;
    public $user;
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
        if($data){
            $this->user='db';
            return $data->id_user;
        }
        else{
            return false;
        }
    }
    public function checkUserLDAP(MAuthorization $auth){
        $ldap=new PhpLDAP($auth);
        if ($ldap->user_ldap){ //проверяем пользователя ldap
            $this->user='ldap';
            $user=new UserDAO();
            $temp=$user->checkUserLDAP($auth->getLogin());
            if($temp){ //Есть ли в бд
                return $temp;
            }
            else{
                $data_user=$ldap->getDataUserLDAP();
                $muser=new MUser();
                $muser->setFirstName($data_user["first_name"]);
                $muser->setLastName($data_user["last_name"]);
                $muser->setLogin($data_user["login"]);
                $muser->setEmail($data_user["mail"]);
                $muser->setLdapUser(1);
                $user->createUser($muser);                
                return $user->setIdUser($muser);
            }
        }
        else {
                return $ldap->user_ldap;                
        }
    }
    public function getIdUser(MAuthorization $auth){
        $temp=$this->checkUserDB($auth);
        if(!$temp){
            $temp= $this->checkUserLDAP($auth);
        }
        return $temp;
        
    }
    public function getAuthUser(MAuthorization $auth){
        if ($this->getUserVasibility($this->getIdUser($auth))){                 
            $this->log->info('Успешно введены логин и пароль пользователем '.$auth->getLogin());
            return $auth->getLogin();
        }
        else{ 
            $this->log->info('Неправильно введены логин и пароль пользователем '.$auth->getLogin());
            return false;
        }
    }     
    public function getObjUser(MAuthorization $auth){
        $query="select * from alluser where id_user=$1;";
        $array_params=array();
        $array_params[]=$this->getIdUser($auth);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getFetchObject($result);
        $muser=new MUser();
        $muser->setFirstName($data->first_name);
        $muser->setEmail($data->email);
        $muser->setRoles($this->getRole($auth));
        $muser->setIdUser($data->id_user);
        $muser->setLastName($data->last_name);
        $muser->setLogin($data->login);
        $muser->setLdapUser(1);
        return $muser;         
    }
    public function getRole(MAuthorization $auth, $id_user=null){
         if($this->user=="ldap"){
             $result= $this->getRoleLDAP($auth);
         }
         else{
             $result= $this->getRoleDB($auth, $id_user);
         }
         
         if ($result){
             $role=array();
             foreach ($result as $value){
                if($value==1){
                    $role[0]=1;
                }
                elseif($value==2){
                    $role[1]=2;
                }
                elseif($value==3){
                    $role[2]=3;
                    }
                }
            return $role;    
         }
         else {
             return false;
         }   
     }
    public function getRoleDB(MAuthorization $auth, $id_user=null){
         $query="select id_role from role_user where id_user=$1";
         $array_params=array();
         if($id_user==null){
            $array_params[]=$this->getIdUser($auth);
         }
         else{
             $array_params[]=$id_user;
         }
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getArrayData($result);
        return $data; 
     }
     //Возвращает массив ролей пользователя
    public function getRoleLDAP(MAuthorization $auth){
         $result=array();
        $array_group=array('interviewee', 'author_quiz', 'administrator');        
        $ldap=new PhpLDAP($auth);
       /* $array_group_user=$ldap->getGroupLDAPUser();
        for($i=0; $i<count($array_group); $i++){
            $config_role=$this->getConfigRole($array_group[$i]);
            foreach($config_role['group'] as $value){
               for($b=0; $b<count($array_group_user); $b++){
                   if($array_group_user[$b]==$value){
                       $result[]=$i+1;
                   }
               }
            }
        } */
        return $result;        
     }
     
    public function getConfigRole ($section){
        $array= parse_ini_file(CheckOS::getConfigRole(), true);
        return $array[$section];
    }
    private function getUserVasibility($id_user){
        if($id_user){
                $admin= new AdministrationDAO();
            if($admin->getStatusUser($id_user)==1){
                return true;
            }
            else{
                return false;
            }
        }
        else{
           return $id_user; 
        }
    }
     
}
?>
