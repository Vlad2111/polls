<?php

class MAuthorization {
    private $login;
    private $password;
    
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
}
?>