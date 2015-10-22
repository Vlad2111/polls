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
    public function createAnswerOptions(MAnswerOptions $answer_options){
        $query="insert into answer_options(id_question, answer_the_questions, right_answer) values ($1, $2, $3);";
        $array_params=array();
        $array_params[]=$answer_options->getIdQuestion();
        $array_params[]=$answer_options->getAnswerTheQuestions();
        $array_params[]=$answer_options->getRightAnswer();
        $this->db->execute($query,$array_params);
        $result=$this->setIdAnswerOptions($answer_options);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблице: answer_option('.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
    //Обновляет вариант ответа
    public function updateAnswerOptions(MAnswerOptions $answer_options){
        $query="UPDATE answer_options SET answer_the_questions=$1, right_answer=$2, id_question=$3 where id_answer_option=$4;";
        $array_params=array();
        $array_params[]=$answer_options->getAnswerTheQuestions();
        $array_params[]=$answer_options->getRightAnswer();
        $array_params[]=$answer_options->getIdQuestion();
        $array_params[]=$answer_options->getIdAnswerOption();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_option('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
 //Удаляет вариант ответа   
    public function deleteAnswerOptions(MAnswerOptions $answer_options){
        $query="DELETE FROM answer_options WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$answer_options->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
//            throw new Exception('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
    public function deleteAnswerOptionsForQuestion($id_question){
        $query="DELETE FROM answer_options WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
//            throw new Exception('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
    public function setIdAnswerOptions(MAnswerOptions $answer_options){
        $query="select id_answer_option from answer_options"
                . " where id_question=$1 and answer_the_questions=$2 and right_answer=$3;";
        $array_params=array();
        $array_params[]=$answer_options->getIdQuestion();
        $array_params[]=$answer_options->getAnswerTheQuestions();
        $array_params[]=$answer_options->getRightAnswer();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if(isset($obj->id_answer_option)){
            $answer_options->setIdAnswerOption($obj->id_answer_option);
            return $obj->id_answer_option;
        }
    }
    public function getListIdAnswerOption($id_question){
        $query="select id_answer_option from answer_options where id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        return $this->db->getArrayData($result);    
    }
    public function getListObjAnswerOption($id_answer_option){
        $query="select * from answer_options where id_answer_option=$1;";
        $array_params=array();
        $array_params[]=$id_answer_option;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj;                
    }
    public function getDataAnswerOtions($id_question){
        $result=array();
        $array_id_answer_option=$this->getListIdAnswerOption($id_question);
        for($i=0; $i<count($array_id_answer_option); $i++){
            $result[$i]=$this->getListObjAnswerOption($array_id_answer_option[$i]);
        }
        return $result;
    }
    public function addRightAnswerOptions($id_answer_option){
        $query="UPDATE answer_options SET  right_answer='Y' where id_answer_option=$1;";
        $array_params=array();
        $array_params[]=$id_answer_option;
        $this->db->execute($query,$array_params);        
    }
    public function resetRightAnswerOptions($id_question){
        $query="update answer_options set right_answer = 'N' where id_question =$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $this->db->execute($query,$array_params);  
    }
    public function getRightAnswerOptions($id_answer_option){
        $query="select right_answer from answer_options where id_answer_option =$1;";
        $array_params=array();
        $array_params[]=$id_answer_option;
        $this->db->execute($query,$array_params);  
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if(isset($obj->right_answer)) {
            return $obj->right_answer;
        }
    }
    
    public function getCountOfRightAnswers($id_question){
        $query="select count(*) from answer_options where id_question = $1 and right_answer = 'Y'";
        $array_params=array();
        $array_params[]=$id_question;
        $this->db->execute($query,$array_params);  
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if(isset($obj->count)) {
            return $obj->count;
        }
    }
}
