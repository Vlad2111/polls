<?php
//require "PHPUnit/Autoload.php";
require "class_db.php";
class class_dbTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfig (){
		$this->assertCount(4, DB::getConfig());	                
    }
    /**
     * @depends testGetConfig
     */
    public function testConnect_db(){
        $this->assertContainsOnly('resource', DB::connect_db());
    }        
    /**
     *@depends testConnect_db
     *@dataProvider providerQuery
    */
    public function TestGetQuery_db($name_colums, $name_table, $query, $array_params){
        $this->assertContainsOnly('resource', DB::getQuery_db($name_colums, $name_table, $query, $array_params));
    }

    public function providerQuery(){
	return array(
            array('id_user', 'alluser', "login=$1 and password=$2", array('Иван', 1)),
            array('role', 'role_user', "id_role=$1", array(1))
	);
    }
    /**
     * @depends testGetConfig
     */
    public function testGetFetch_result(){
        $query=DB::getQuery_db('id_user', 'alluser', "login=$1 and password=$2", array('Иван', 1));
        $this->assertEquals(1, DB::getFetch_result($query));
    }
    

	
}

?>