<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
Logger::configure('setting/config.xml');
class IntervieweeDAO {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function getListQuiz($interviewee){
        $query="select id_test from testing where id_user=$1;";
        $array_params=array();
        $array_params[]=$interviewee->get();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
        }   
    }
    public function startQuiz($interviewee){
        $query="  UPDATE testing SET datetime_start_test=$1, "
                . "mark_test='unfinished' where id_test=$2 and id_user=$3 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->get();
        $array_params[]=$interviewee->get();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
        }         
    }
    public function endQuiz($interviewee){
        $query="  UPDATE testing SET datetime_end_test=$1, "
                . "mark_test='not available' where id_test=$2 and id_user=$3 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->get();
        $array_params[]=$interviewee->get();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
        }      
    }
    public function interruptQuiz($interviewee){
        
    }
    public function continueTheQuiz($interviewee){
        
    }
    public function answerTheQuestion($interviewee) {
        
    }
    public function editAnswerTheQuestion($interviewee){
        
    }
    private function getMarker($interviewee){
        
    }
}
?>
