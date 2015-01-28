<?php
include_once 'DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
    LoggerNDC::push("Some Context");
class Test {
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createTest($array_values){
        $str_values="nextval('id'),";
        for($i=0; $i<count($array_values);$i++){//составляем строку из значений для запроса
            if($i==count($array_values)-1){
                $str_values.="'$array_values[$i]'";
                break;                
            }
            $str_values.="'$array_values[$i]', ";    
        }
        $this->db->insertDb("test", $str_values);        
        $this->log->info('Добавлен новый тест: '.$array_values[0]);
    }
    public function editTest(){
        
    }
    public function deleteTest(){
        
    }
    public function addQuestion(){
        
    }
    public function editQuestion(){
        
    }
    public function deleteQuestion(){
        
    }
    public function addLimitTime(){
        
    }
    public function editLimitTime(){
        
    }
    public function deleteLimitTime(){
        
    }
    public function assignUsers(){
        
    }
}
