<?php
include_once 'DB.php';
include_once 'Values_quize.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
    LoggerNDC::push("Some Context");
class Values_quize_DAO {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createQuize($quize){
        $query="INSERT INTO test(id_test, topic, time_limit, comment, see_the_result, see_details, status)
                VALUES ($quize->id_quize, '$quize->topic', '$quize->time_limit', '$quize->comment',"
                . "'$quize->see_the_result', '$quize->see_the_details', '$quize->status');"; 
        if($this->db->execute($query)){}  
        else  {
            $this->log->ERROR('Ошибка добавления строки в таблицу: test'); 
            throw new Exception('Ошибка добавления строки в таблицу: test');            
        }
    }
    public function updateQuize($quize){
        $query="UPDATE test SET topic='$quize->topic', time_limit='$quize->time_limit',"
                . " comment='$quize->comment', see_the_result='$quize->see_the_result',"
                . " see_details='$quize->see_the_details', status='$quize->status'"
                . " where id_test='$quize->id_quize';";
        if($this->db->execute($query)){}  
        else{ 
            $this->log->ERROR('Ошибка обновления строки в таблице: test'); 
            throw new Exception('Ошибка обновления строки в таблице: test');         
        }
    }
    public function deleteQuize($quize){
        $query="DELETE FROM test WHERE id_test='$quize->id_quize';";
        if($this->db->execute($query)){}  
        else{ 
            $this->log->ERROR('Ошибка удаления строки в таблице: test'); 
            throw new Exception('Ошибка удаления строки в таблице: test');     
        }
    }
    
}
