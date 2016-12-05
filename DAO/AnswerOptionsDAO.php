<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
Logger::configure(CheckOS::getConfigLogger());
class AnswerOptionsDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    //Создает вариант ответа
    public function createAnswerOptions(MAnswerOptions $answer_options) {
        try {
            $query="insert into answer_options(id_question, answer_the_questions, right_answer) values ($1, $2, $3);";
            $array_params=array();
            $array_params[]=$answer_options->getIdQuestion();
            $array_params[]=$answer_options->getAnswerTheQuestions();
            $array_params[]=$answer_options->getRightAnswer();
            $this->db->executeAsync($query,$array_params);
            $result=$this->setIdAnswerOptions($answer_options);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    //Обновляет вариант ответа
    public function updateAnswerOptions(MAnswerOptions $answer_options) {
        try {
            $query="UPDATE answer_options SET answer_the_questions=$1, right_answer=$2, id_question=$3 where id_answer_option=$4;";
            $array_params=array();
            $array_params[]=$answer_options->getAnswerTheQuestions();
            $array_params[]=$answer_options->getRightAnswer();
            $array_params[]=$answer_options->getIdQuestion();
            $array_params[]=$answer_options->getIdAnswerOption();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        } 
    }
 //Удаляет вариант ответа   
    public function deleteAnswerOptions(MAnswerOptions $answer_options) {
        try {
            $query="DELETE FROM answer_options WHERE id_question=$1;";
            $array_params=array();
            $array_params[]=$answer_options->getIdQuestion();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function deleteAnswerOptionsForQuestion($id_question) {
        try {
            $query="DELETE FROM answer_options WHERE id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getIdAnswerOptionsByIdQuestion($idQuestion) {
        try {
            $query="select id_answer_option from answer_options"
                    . " where id_question=$1;";
            $array_params=array();
            $array_params[]=$idQuestion;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->id_answer_option)){
                return $obj->id_answer_option;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка установки строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function setIdAnswerOptions(MAnswerOptions $answer_options) {
        try {
            $query="select id_answer_option from answer_options"
                    . " where id_question=$1 and answer_the_questions=$2 and right_answer=$3;";
            $array_params=array();
            $array_params[]=$answer_options->getIdQuestion();
            $array_params[]=$answer_options->getAnswerTheQuestions();
            $array_params[]=$answer_options->getRightAnswer();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->id_answer_option)){
                $answer_options->setIdAnswerOption($obj->id_answer_option);
                return $obj->id_answer_option;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка установки строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getListIdAnswerOption($id_question) {
        try {
            $query="select id_answer_option from answer_options where id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result);  
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getListObjAnswerOption($id_answer_option) {
        try {
            $query="select * from answer_options where id_answer_option=$1;";
            $array_params=array();
            $array_params[]=$id_answer_option;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj;     
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }            
    }
    public function getDataAnswerOtions($id_question){
        $result=array();
        $array_id_answer_option=$this->getListIdAnswerOption($id_question);
        for($i=0; $i<count($array_id_answer_option); $i++){
            $result[$i]=$this->getListObjAnswerOption($array_id_answer_option[$i]);
        }
        return $result;
    }
    public function addRightAnswerOptions($id_answer_option) {
        try {
            $query="UPDATE answer_options SET  right_answer='Y' where id_answer_option=$1;";
            $array_params=array();
            $array_params[]=$id_answer_option;
            $this->db->executeAsync($query,$array_params);   
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления ответа в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }      
    }
    public function resetRightAnswerOptions($id_question) {
        try {
            $query="update answer_options set right_answer = 'N' where id_question =$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $this->db->executeAsync($query,$array_params);  
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка сброса верного ответа в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getRightAnswerOptions($id_answer_option) {
        try {
            $query="select right_answer from answer_options where id_answer_option =$1;";
            $array_params=array();
            $array_params[]=$id_answer_option; 
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->right_answer)) {
                return $obj->right_answer;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения верного ответа в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }
    }
    
    public function getCountOfRightAnswers($id_question) {
        try {
            $query="select count(*) from answer_options where id_question = $1 and right_answer = 'Y'";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->count)) {
                return $obj->count;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения количества верных ответов в таблице: answer_option '.$e->getMessage().$e->getTraceAsString());
        }
    }
}
