<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MUser.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
    Logger::configure('setting/config.xml');
class AdministrationView{
    public $id_user;
    public $button_click;
    public $link_click;
    public $data_edit_user;
    public $title="Пользователи системы";
    public $view_admin = 'table_users'; //По умолчанию отображаем пользователей
    public $other_data_user;
    private $admin;
   
    public function __construct (){       
        $this->id_user=filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->admin=new AdministrationDAO();
       $this->init();
    }
    public function init (){
        if(isset($this->link_click) && !empty($this->link_click)){
            if ($this->link_click=='show_quiz'){  
                $this->title = "Опросы системы";
                $this->view_admin='table_quizs';
            }
            elseif ($this->link_click=='new_internal_user'){   
                $this->title = "Создать нового пользователя";
                $this->view_admin='new_internal_user';         
            }
            elseif ($this->link_click=='edit_user'){    
                $this->view_admin='edit_user';
                $this->title = "Редактировать пользователя";
                $this->data_edit_user = $this->admin->getObjDataUser($this->id_user);
                $this->other_data_user= $this->getDataEditUser($this->id_user);    
            } 
        }
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action'] == 'deleteUser' && !empty ($_GET['id_user'])){  
                $this->deleteUser($_GET['id_user']);
                header("Location: administration.php?link_click=show_users");      
				exit;
            }
        }
        if(isset($this->button_click) && !empty($this->button_click)){
            if ($this->button_click=="create_internal_user"){ 
               $this->createInternalUser();
               header("Location: administration.php?link_click=show_users");
               exit;
            }            
        }
    }
    public function getUsersData(){
        return $this->admin->getDataUsers();
    }
    public function getQuizsData(){
        return $this->admin->getDataQuizs();
    }
    public function createInternalUser (){     
       $role_user = array();
       $role_user[]= intval(filter_input(INPUT_POST, 'role_admin', FILTER_SANITIZE_SPECIAL_CHARS));
       $role_user[]= intval(filter_input(INPUT_POST, 'role_author', FILTER_SANITIZE_SPECIAL_CHARS));
       $role_user[]= intval(filter_input(INPUT_POST, 'role_interviewees', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser=new MUser();
       $muser->setLastName(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser->setFirstName(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser->setLogin(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser->setPassword(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
       $muser->setRoles($role_user);
       $muser->setLdapUser(0);
       $this->admin->createUser($muser);
       $this->admin->addRole($muser);
      
    }
    public function updateUser($id_user, $last_name, $first_name, $email, $login, $role_user, $create_new_password, $new_password){
       $muser=new MUser();
       $muser->setIdUser($id_user);       
       $muser->setLastName($last_name);
       $muser->setFirstName($first_name);
       $muser->setEmail($email);
       $muser->setLogin($login);
       $muser->setRoles($role_user);
       $muser->setLdapUser(0);
       $this->admin->deleteAllRoleUser($muser);
       $this->admin->updateUser($muser);
       $this->admin->addRole($muser);
       if($create_new_password=="Yes"){
           $muser->setPassword($new_password);
           $this->admin->resetPassword($muser);
       }
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
    public function setStatusUser($id_user, $status){
        $this->admin->setStatusUser($id_user, $status);
    }
    public function setStatusQuiz($id_quiz, $status){
        $quiz=new QuizDAO();
        $quiz->setVasibilityQuiz($id_quiz, $status);
    } 
}

