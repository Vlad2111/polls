<?php
class ValuesAdministration {
    private $id_user;
    private $last_name;
    private $first_name;
    private $patronymic;
    private $type;
    private $email;
    private $login;
    private $password;
    private $id_role;
    private $description;
   
    public function getIdUser(){
	return $this->id_user;
    }
    public function setIsUser($id_user){
	$this->last_name=$id_user;
    }
    public function getLastName(){
	return $this->last_name;
    }
    public function setLastName($last_name){
	$this->last_name=$last_name;
    }
    public function getFirstName(){
	return $this->first_name;
    }
    public function setFirstName($first_name){
	$this->last_name=$first_name;
    }
    public function getPatronymic(){
	return $this->patronymic;
    }
    public function setPatronymic($patronymic){
	$this->patronymic;
    }
    public function getType(){
	return $this->type; 
    }
    public function setType($type){
	$this->type=$type;
    }
    public function getEmail(){
	return $this->email;
    }
    public function setEmail($email){
	$this->email=$email;
    }
    public function getLogin(){
	return $this->login;
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
    public function getIdRole(){
        return $this->id_role;
    }
    public function setIdRole($id_role){
        $this->id_role=$id_role;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description=$description;
    }
}
?>
