<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'model/MUser.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
class AdministrationView{
    public $admin;
    public function __construct() {
        $this->admin=new AdministrationDAO();
    }
    public function getUsersData(){
        return $this->admin->getDataUsers();
    }
    public function getQuizsData(){
          return $this->admin->getDataQuizs();
    }
    public function createInternalUser($last_name, $first_name, $email, $login, $password, $role_user){
       $muser=new MUser();
       $muser->setLastName($last_name);
       $muser->setFirstName($first_name);
       $muser->setEmail($email);
       $muser->setLogin($login);
       $muser->setPassword($password);
       $muser->setRoles($role_user);
       $this->admin->createUser($muser);
       $this->admin->addRole($muser);
    }
    public function updateUser($id_user, $last_name, $first_name, $email, $login, $role_user){
       $muser=new MUser();
       $muser->setIdUser($id_user);       
       $muser->setLastName($last_name);
       $muser->setFirstName($first_name);
       $muser->setEmail($email);
       $muser->setLogin($login);
       $muser->setRoles($role_user);
       $this->admin->deleteAllRoleUser($muser);
       $this->admin->updateUser($muser);
       $this->admin->addRole($muser);
    }
        //Возращаем информацию связанную с данным пользователем
    public function getDataEditUser($id_user){
        $return=array();
        $return['test']=$this->admin->getTestsAuthor($id_user);
        $return['testing']=$this->admin->getTestingUser($id_user);
        return $return;
    }
    public function deleteUser($id_user){
        $muser=new MUser();
        $muser->setIdUser($id_user);
        $this->admin->deleteAllRoleUser($muser);
        $this->admin->deleteUser($muser);
    }

    
    

}
