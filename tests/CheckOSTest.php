<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CheckOSTest
 *
 * @author Aleksey Porandaykin
 */
chdir("/var/www/html/");
include_once 'lib/CheckOS.php';
//Tests for Unix OS
class CheckOSTest extends PHPUnit_Framework_TestCase {
    public function testConfigLogger(){
        $this->assertEquals('/etc/config_log4php.xml', CheckOS::getConfigLogger());
    }
    public function testConfigConnectDb(){
        $this->assertEquals("/etc/config_dike.ini", CheckOS::getConfigConnectDb());
    }
    public function testConfigRole(){
        $this->assertEquals("/etc/role_dike.ini", CheckOS::getConfigRole());
    }
}
