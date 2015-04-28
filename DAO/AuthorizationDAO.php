<?php
include_once 'model/MUser.php';
include_once 'DAO/UserDAO.php';
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'lib/PhpLDAP.php';
include_once 'Log4php/Logger.php';
include_once 'model/MUser.php';
    Logger::configure(CheckOS::getConfigLogger());
class AuthorizationDAO {
    protected $db;
    protected $log;
    private $user;
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
        if ($this->getIdUser($auth)){                 
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
    public function getRole(MAuthorization $auth){
         if($this->user=="ldap"){
             return $this->getRoleLDAP($auth);
         }
         else{
             return $this->getRoleDB($auth);
         }
     }
    public function getRoleDB(MAuthorization $auth){
         $query="select id_role from role_user where id_user=$1";
         $array_params=array();
        $array_params[]=$this->getIdUser($auth);
        $result=$this->db->execute($query,$array_params);
        $data=$this->db->getArrayData($result);
        return $data; 
     }
     //Возвращает массив ролей пользователя
    public function getRoleLDAP(MAuthorization $auth){
         $result=array();
        $array_group=array('interviewee', 'author_quiz', 'administrator');        
        $ldap=new PhpLDAP($auth);
        $array_group_user=$ldap->getGroupLDAPUser();
        for($i=0; $i<count($array_group); $i++){
            $config_role=$this->getConfigRole($array_group[$i]);
            foreach($config_role['group'] as $value){
               for($b=0; $b<count($array_group_user); $b++){
                   if($array_group_user[$b]==$value){
                       $result[]=$i+1;
                   }
               }
            }
        }
        return $result;        
     }
     
    public function getConfigRole ($section){
        $array= parse_ini_file(CheckOS::getConfigRole(), true);
        return $array[$section];
     }
     
}
?>
