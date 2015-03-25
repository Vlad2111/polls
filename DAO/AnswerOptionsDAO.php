<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
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
        $query="insert into answer_options(answer_the_questions, right_answer) values ($1, $2);";
        $array_params=array();
        $array_params[]=$answer_options->getAnswerTheQuestions();
        $array_params[]=$answer_options->getRightAnswer();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблице: answer_option('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
    //Обновляет вариант ответа
    public function updateAnswerOptions(MAnswerOptions $answer_options){
        $query="UPDATE answer_options SET answer_the_questions=$1, right_answer=$2 where id_answer_option=$3;";
        $array_params=array();
        $array_params[]=$answer_options->getAnswerTheQuestions();
        $array_params[]=$answer_options->getRightAnswer();
        $array_params[]=$answer_options->getIdAnswerOption();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_option('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
 //Удаляет вариант ответа   
    public function deleteAnswerOptions(MAnswerOptions $answer_options){
        $query="DELETE FROM answer_options WHERE id_answer_option=$1;";
        $array_params=array();
        $array_params[]=$answer_options->getIdAnswerOption();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: answer_option('.pg_last_error().')'); 
        }
    }
    //Связывает вариант ответа с вопросом
    public function createAnswerQuestion(MAnswerOptions $answer_options){
        $query="insert into question_answer_options(id_question, id_answer_option) values ($1, $2);";
        $array_params=array();
        $array_params[]=$answer_options->getIdQuestion();
        $array_params[]=$answer_options->getIdAnswerOption();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблице: question_answer_options('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблице: question_answer_options('.pg_last_error().')'); 
        }
    }
    //Разрвает связь варианта ответа с вопросом
    public function deleteAnswerQuestion(MAnswerOptions $answer_options){
        $query="DELETE FROM question_answer_options WHERE id_question=$1 and id_answer_option=$2;";
        $array_params=array();
        $array_params[]=$answer_options->getIdQuestion();
        $array_params[]=$answer_options->getIdAnswerOption();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: question_answer_options('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: question_answer_options('.pg_last_error().')'); 
        }
    }
}