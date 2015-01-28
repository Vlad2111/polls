<?php
include_once 'DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
    LoggerNDC::push("Some Context");
class Quiz {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createQuiz($array){
        foreach ($array as $key => $value) {
            $array_names_colums[]=$key;
            $array_values[]=$value;
        }
        $str_values="";
        $str_names_colums="";
        for($i=0; $i<count($array);$i++){
            if($i==count($array)-1){
                $str_values.="'$array_values[$i]'";
                $str_names_colums.="$array_names_colums[$i]";
                break;                
            }
            $str_values.="'$array_values[$i]', ";
            $str_names_colums.="$array_names_colums[$i], "; 
        }
        $this->db->insertDb('test',$str_values, $str_names_colums);    
    }
    public function editQuiz($id_test,$array){
        foreach ($array as $key => $value) {
            $array_names_colums[]=$key;
            $array_values[]=$value;
        }
        $quest="";
        for($i=0; $i<count($array);$i++){
            if($i==count($array)-1){
                $quest.="$array_names_colums[$i]='$array_values[$i]' ";
                break;                
            }
            $quest.="$array_names_colums[$i]='$array_values[$i]', "; 
        }
        $quest.="where id_test=$id_test";
        $this->db->updateDb('test',$quest);
    }
    public function deleteQuiz($id_test){
        $query="id_test=$id_test";
        $this->db->deleteDb('test', $query);
    }
    public function addQuestion($id_test){
        
    }
    public function editQuestion($id_test){
        
    }
    public function deleteQuestion($id_test){
        
    }
    public function addLimitTime($id_test){
        
    }
    public function editLimitTime($id_test){
        
    }
    public function deleteLimitTime($id_test){
        
    }
    public function assignUsers($id_test){
        
    }
}
