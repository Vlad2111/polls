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
    public function createTesting(MInterviewee $interviewee, $id_mark_test) {
        try {
            $query="insert into testing(id_user, id_test, id_mark_test) values 
                    ($1, $2, $3);";
            $array_params=array();
            $array_params[]=$interviewee->getUser()->getIdUser();
            $array_params[]=$interviewee->getTest()->getIdQuiz();
            $array_params[]=$id_mark_test;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $this->setIdTesting($interviewee);            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: testing '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function updateTesting(MInterviewee $interviewee) {
        try {
            $query="UPDATE testing SET id_user=$1, id_test=$2, id_mark_test=$3 where id_testing=$4;";
            $array_params=array();
            $array_params[]=$interviewee->getUser()->getIdUser();
            $array_params[]=$interviewee->getTest()->getIdQuiz();
            $array_params[]=$interviewee->getMarkTest();
            $array_params[]=$interviewee->getIdTesting();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function deleteTesting(MInterviewee $interviewee) {
        try {
            $query="DELETE FROM testing WHERE id_testing=$1;";
            $array_params=array();
            $array_params[]=$interviewee->getIdTesting();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function deleteForQuiz($id_test) {
        try {
            $query="DELETE FROM testing WHERE id_test=$1;";
            $array_params=array();
            $array_params[]=$id_test;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function editMarkTest(MInterviewee $interviewee, $id_mark_test) {
        try {
            $query="UPDATE testing SET id_mark_test=$1 where id_testing=$2;";
            $array_params=array();
            $array_params[]=$id_mark_test;
            $array_params[]=$interviewee->getIdTesting();
            $this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function setDatetimeStartTest(MInterviewee $interviewee, $datetime_start_test) {
        try {
            $query="UPDATE testing SET datetime_start_test=$1 where id_testing=$2;";
            $array_params=array();
            $array_params[]=$datetime_start_test;
            $array_params[]=$interviewee->getIdTesting();
            $this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getDatetimeStartTest(MInterviewee $interviewee) {
        try {
            $query="select datetime_start_test from testing where id_testing=$1;";
            $array_params=array();
            $array_params[]=$interviewee->getIdTesting();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->datetime_start_test;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function setDatetimeEndTest(MInterviewee $interviewee, $datetime_start_test) {
        try {
            $query="UPDATE testing SET datetime_end_test=$1 where id_testing=$2;";
            $array_params=array();
            $array_params[]=$datetime_start_test;
            $array_params[]=$interviewee->getIdTesting();
            $this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getDatetimeEndTest(MInterviewee $interviewee) {
        try {
            $query="select datetime_end_test from testing where id_testing=$1;";
            $array_params=array();
            $array_params[]=$interviewee->getIdTesting();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->datetime_end_test)){
                return $obj->datetime_end_test;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function setIdTesting(MInterviewee $interviewee) {
        try {
            $query="select * from testing where id_user=$1 and id_test=$2;";
            $array_params=array();
            $array_params[]=$interviewee->getUser()->getIdUser();
            $array_params[]=$interviewee->getTest()->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            $interviewee->setIdTesting($obj->id_testing);
            return $obj->id_testing;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getIdTesting($id_user, $id_quiz) {
        try {
            $query="select * from testing where id_user=$1 and id_test=$2;";
            $array_params=array();
            $array_params[]=$id_user;
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->id_testing)){
                return $obj->id_testing;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getIdTestingForQuiz($id_quiz) {
        try {
            $query="select * from testing where id_test=$1;";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getArrayData($result);
            return $obj;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function setAnswers(MInterviewee $interviewee, $result) {
        try {
            $query="UPDATE testing SET right_answers=$1,wrong_answers=$2,skip_answers=$3, unvalidated_answers=$4 where id_testing=$5;";
            $array_params=array();
            $array_params[]=$result['right'];
            $array_params[]=$result['wrong'];
            $array_params[]=$result['skip'];
            $array_params[]=$result['unvalidated'];
            $array_params[]=$interviewee->getIdTesting();
            $this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getAnswers($id_testing) {
        try {
            $query="select right_answers,wrong_answers,skip_answers, unvalidated_answers from testing where id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function setInterval($id_testing) {
        try {
            $query="Update testing set datetime_duration_test=(select datetime_end_test from testing where id_testing=$1)-(select datetime_start_test from testing where id_testing=$1) where id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getInterval($id_testing) {
        try {
            $query="select datetime_duration_test from testing where id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->datetime_duration_test)){
                return $obj->datetime_duration_test;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: testing '.$e->getMessage().$e->getTraceAsString());
        }
    }
}
