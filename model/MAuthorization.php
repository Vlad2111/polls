<?php

class MAuthorization {
    private $login;
    private $password;
    private $user;
    private $passwordLDAP;
    
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login=  trim($login);
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password=md5($password);
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser(MUser $user){
        $this->user=$user;
    }
//    public function getLoginLDAP(){
//        return $this->loginLDAP;
//    }
//    public function setLoginLDAP($login){
//        $this->loginLDAP="TECOM\\".$login;
//    }
    public function getPasswordLDAP(){
        return $this->passwordLDAP;
    }
    public function setPasswordLDAP($password){
        $this->passwordLDAP=$password;
    }
    
    }
?>