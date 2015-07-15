<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
class TestingDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function createTesting(MInterviewee $interviewee, $id_mark_test){
        $query="insert into testing(id_user, id_test, id_mark_test) values 
                ($1, $2, $3);";
        $array_params=array();
        $array_params[]=$interviewee->getUser()->getIdUser();
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $array_params[]=$id_mark_test;
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $this->setIdTesting($interviewee);            
        }
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: testing( '.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблицу: testing( '.pg_last_error().')');  
        }   
    }
    public function updateTesting(MInterviewee $interviewee){
        $query="UPDATE testing SET id_user=$1, id_test=$2, id_mark_test=$3 where id_testing=$4;";
        $array_params=array();
        $array_params[]=$interviewee->getUser()->getIdUser();
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $array_params[]=$interviewee->getMarkTest();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: testing( '.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: testing( '.pg_last_error().')');  
        }
    }
    public function deleteTesting(MInterviewee $interviewee){
        $query="DELETE FROM testing WHERE id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: testing( '.pg_last_error().')'); 
//            throw new Exception('Ошибка удаления строки в таблице: testing( '.pg_last_error().')');  
        }
    }
    public function editMarkTest(MInterviewee $interviewee, $id_mark_test){
        $query="UPDATE testing SET id_mark_test=$1 where id_testing=$2;";
        $array_params=array();
        $array_params[]=$id_mark_test;
        $array_params[]=$interviewee->getIdTesting();
        $this->db->execute($query,$array_params);
    }
    public function setDatetimeStartTest(MInterviewee $interviewee, $datetime_start_test){
        $query="UPDATE testing SET datetime_start_test=$1 where id_testing=$2;";
        $array_params=array();
        $array_params[]=$datetime_start_test;
        $array_params[]=$interviewee->getIdTesting();
        $this->db->execute($query,$array_params);
    }
    public function setDatetimeEndTest(MInterviewee $interviewee, $datetime_start_test){
        $query="UPDATE testing SET datetime_end_test=$1 where id_testing=$2;";
        $array_params=array();
        $array_params[]=$datetime_start_test;
        $array_params[]=$interviewee->getIdTesting();
        $this->db->execute($query,$array_params);
    }
    public function setIdTesting(MInterviewee $interviewee){
        $query="select * from testing where id_user=$1 and id_test=$2;";
        $array_params=array();
        $array_params[]=$interviewee->getUser()->getIdUser();
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $interviewee->setIdTesting($obj->id_testing);
        return $obj->id_testing;
    }
    public function setAnswers(MInterviewee $interviewee, $result){
        $query="UPDATE testing SET right_answers=$1,wrong_answers=$2,skip_answers=$3 where id_testing=$4;";
        $array_params=array();
        $array_params[]=$result['right'];
        $array_params[]=$result['wrong'];
        $array_params[]=$result['skip'];
        $array_params[]=$interviewee->getIdTesting();
        $this->db->execute($query,$array_params);
    }
    public function getAnswers($id_testing){
        $query="select right_answers,wrong_answers,skip_answers from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj;
    }
    public function setInterval($id_testing){
        $query="Update testing set datetime_duration_test=(select datetime_end_test from testing where id_testing=$1)-(select datetime_start_test from testing where id_testing=$1) where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $this->db->execute($query,$array_params);
    }
    public function getInterval($id_testing){
        $query="select datetime_duration_test from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->datetime_duration_test;
    }
}
