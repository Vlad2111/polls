<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigFile
 *
 * @author Aleksey Porandaykin
 */
class ConfigFile {
    protected static $_instance;
    public $array_params;

    public static function getInstance() { // получить экземпляр данного класса 
        if (self::$_instance === null) { // если экземпляр данного класса  не создан
            self::$_instance = new self;  // создаем экземпляр данного класса 
        } 
        return self::$_instance; // возвращаем экземпляр данного класса
    }

    private function __construct() { 
        $this->array_params = $this->getConfigDB();
    }
    public static function getConfigDB (){
        $array= parse_ini_file(CheckOS::getConfigConnectDb(), true);
        return $array;
    }
    
}
