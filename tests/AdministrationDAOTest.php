<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'model/ValuesAdministration.php';
include_once 'lib/DB.php';
class QuizDAOTest extends PHPUnit_Framework_TestCase {
    public $values_admin;
    public $admin;
    public function getValues(){
        $values_admin= new ValuesAdministration();
        $values_admin->setLastName('Иван');
        $values_admin->setFirstName('Иванов');
        $values_admin->setPatronymic('Иваныч');
        $values_admin->setType('for_test');
        $values_admin->setEmail('test@test.com');
        $values_admin->setlogin('test');
        $values_admin->setPassword('test');
        $values_admin->setDescription('test');
        $values_admin->setIdRole(1);
        $this->values_admin->$values_admin;
        $this->admin=new AdministrationDAO();
    }
    /**
     * @depends getValues
     */
    public function testCreateUser(){
        $this->assertContainsOnly('resource', $this->admin->createUser($this->values_admin));
    }
    /**
     * @depends testCreateUser
     */
    public function getIdUser(){
        $query="SELECT id_user FROM alluser WHERE last_name=$1 and first_name=$2 and"
                . " patronymic=$3;";
        $array_params=array();
        $array_params[]=$admin->getLastName();
        $array_params[]=$admin->getFirstName();
        $array_params[]=$admin->getPatronymic;
        $result=$this->db->execute($query,$array_params);
        $obj= $this->db->getFetchObject($result);
        $this->values_admin->setIdUser($obj->id_user);
    }
    /**
     * @depends getIdUser
     */
    public function testUpdateUser(){
        $this->assertContainsOnly('resource', $this->admin->updateUser($this->values_admin));
    }
    /**
     * @depends testUpdateUser
     */
    public function testAddRole(){
        $this->assertContainsOnly('resource', $this->admin->addRole($this->values_admin));
    }
    /**
     * @depends testCreateUser
     */
    public function testResetPassword(){
        $this->assertContainsOnly('resource', $this->admin->resetPassword($this->values_admin));
    }
    /**
     * @depends testCreateUser
     */
    public function testDeleteUser(){
        $this->assertContainsOnly('resource', $this->admin->deleteUser($this->values_admin));
    }/**
     * @depends testDeleteUser
     */
    public function testDeleteRole(){
        $this->assertContainsOnly('resource', $this->admin->deleteRole($this->values_admin));
    }
}
