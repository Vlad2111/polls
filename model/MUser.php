<?php
class MUser {
    private $id_user;
    private $last_name;
    private $first_name;
    private $email;
    private $login;
    private $password;
    private $ldap_user;
    private $roles; //array
    private $availableTests;
    private $user_vasibility;
   
    public function getIdUser(){
	return $this->id_user;
    }
    public function setIdUser($id_user){
	$this->id_user=$id_user;
    }
    public function getLastName(){
	return trim($this->last_name);
    }
    public function setLastName($last_name){
	$this->last_name=$last_name;
    }
    public function getFirstName(){
	return trim($this->first_name);
    }
    public function setFirstName($first_name){
	$this->first_name=$first_name;
    }
    public function getLdapUser(){
        return $this->ldap_user;
    }
    public function setLdapUser($ldap_user){
        $this->ldap_user=$ldap_user;
    }
    public function getEmail(){
	return trim($this->email);
    }
    public function setEmail($email){
	$this->email=$email;
    }
    public function getLogin(){
	return trim($this->login);
    }
    public function setLogin($login){
    	$this->login=$login;
    }
    public function getPassword(){
    	return $this->password;
    }
    public function setPassword($password){
	$this->password=md5($password);
    }
    public function getRoles(){
        return $this->roles;
    }
    public function setRoles($roles){
        $this->roles=$roles;
    }
    public function getAvailableTests(){
        return $this->availableTests;
    }
    public function setAvailableTests(MInterviewee $availabale_tests){
        $this->availableTests=$availabale_tests;
    }
    public function getUserVasibility(){
        return $this->user_vasibility;
    }
    public function setUserVasibility($user_vasibility){
        $this->user_vasibility=$user_vasibility;
    }
}
?>
