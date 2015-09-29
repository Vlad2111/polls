<?php
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
class AuthorizationView {
    public $error="";
    private $login;
    private $password;
    private $link_click;
    
    public function __construct() {
        $this->login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->link_click = filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->initialize();
    }
    private function initialize(){
        if( isset($this->login) && isset($this->password) ){
            if ( !empty($this->login) && !empty($this->password) ){            
                $this->checkParamUser();
            }
        }
        if ( isset($this->link_click) && !empty($this->link_click) ){
            if ($this->link_click == 'exit'){
                $this->destroyParamUser();
            }
        }
    }
    private function checkParamUser(){
        $mauth= new MAuthorization();
        $mauth->setLogin($this->login);
        $mauth->setPassword($this->password);
        $mauth->setPasswordLDAP($this->password);
        $dao_auth=new AuthorizationDAO();
        if ($dao_auth->getAuthUser($mauth)){
            $obj_user=$dao_auth->getObjUser($mauth);
            $_SESSION['id_user']=$dao_auth->getIdUser($mauth);
            $_SESSION['fio_user']=$obj_user->getFirstName()." ".$obj_user->getLastName(); 
            $_SESSION['role_user']=$dao_auth->getRole($mauth);
            header('HTTP/1.1 200 OK');
            header('Location: main.php');
            exit();
        }
        $this->error="Неправильный пользователь или пароль";
    }
    private function destroyParamUser(){
        $_SESSION=array();
        session_destroy();
    }
    
}
