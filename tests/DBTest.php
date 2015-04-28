<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBTest
 *
 * @author Aleksey Porandaykin
 */
chdir("/var/www/html/");
    include_once "lib/DB.php";
class DBTest  extends PHPUnit_Framework_TestCase
{
    public $db_temp;
    public function __construct() {
        $this->db_temp=DB::getInstance();
    }
    public function testGetConfig (){
	$this->assertCount(5, $this->db_temp->getConfig());	                
    }
    /**
     * @depends testGetConfig
     */
    public function testExecuteCreateTable(){
        $query="create table table_for_test(
	id int not null,
	value_test character(20) null
    );
    insert into table_for_test values
	(1, 'one'),
	(2, 'two');";
        $this->assertInternalType('resource', $this->db_temp->execute($query));
    }
    /**
     * @depends testExecuteCreateTable
     */
    public function testGetFetchObject(){
        $array_params=array();
        $query="select * from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$this->db_temp->execute($query, $array_params);        
        $obj=$this->db_temp->getFetchObject($execute);
        $this->assertInternalType('object', $obj);	        
        $this->assertEquals(2, $obj->id);
        $this->assertEquals('two', trim($obj->value_test));
    }
    public function testGetArrayData(){
        $array_params=array();
        $query="select value_test from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$this->db_temp->execute($query, $array_params);
        $array=$this->db_temp->getArrayData($execute);
        $this->assertCount(1, $array);
        $this->assertEquals('two', trim($array[0]));
    }
    
    public function testExecuteDeleteTable(){
         $query="drop table  table_for_test;";
        $this->assertInternalType('resource', $this->db_temp->execute($query));
    }
}
/*
 * 
 * $db=  DB::getInstance();
    echo "<pre>";    
    echo "Проверяем config: <br>";
    var_dump($db->getConfig());
    echo "<hr>";
    echo "Проверяем execute pg_query: <br>";
    $query="create table table_for_test(
	id int not null,
	value_test character(20) null
    );
    insert into table_for_test values
	(1, 'one'),
	(2, 'two');";
    var_dump($db->execute($query));
    echo "<hr>";
    
    echo "Проверяем getFetchObject: <br>";
        $array_params=array();
        $query="select * from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$db->execute($query, $array_params);
        var_dump($db->getFetchObject($execute));    
    echo "<hr>";
//    
    echo "Проверяем getArrayData: <br>";
        $array_params=array();
        $query="select * from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$db->execute($query, $array_params);
        var_dump($db->getArrayData($execute));    
    echo "<hr>";
    
    echo "Удаляем таблицу: <br>";
    $query="drop table  table_for_test;";
    var_dump($db->execute($query));
    echo "<hr>";
    echo "</pre>";
 * 
 * 
 * create table table_for_test(
	id int not null,
	value_test character(20) null
);

insert into table_for_test values
	(1, 'one'),
	(2, 'two');

select * from table_for_test;

select * from table_for_test where id=2;



drop table  table_for_test;
 */

