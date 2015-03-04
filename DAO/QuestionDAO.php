<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
Logger::configure('/etc/config_log4php.xml');
class QuestionDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    public function createQuestion(MQuestions $questions){
        $query="INSERT INTO questions(texts, id_answer_type, id_answer_the_questions, comment_question)
        VALUES ($1, $2, $3, $4);"; 
        $array_params=array();
        $array_params[]=$questions->getTexts();
        $array_params[]=$questions->getIdAnswerType();
        $array_params[]=$questions->getIdAnswerTheQuestions();
        $array_params[]=$questions->getCommentQuestion();

        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
        }  
    }
    public function updateQuestion(MQuestions $questions){
        $query="UPDATE questions SET texts=$1, id_answer_type=$2,"
                . " id_answer_the_questions=$3, comment_question=$4,"
                . " where id_question=$5;";
        $array_params=array();
        $array_params[]=$questions->getTexts();
        $array_params[]=$questions->getType();
        $array_params[]=$questions->getAnswer();
        $array_params[]=$questions->getCommentQuestion();       
        $array_params[]=$questions->getIdQuestion();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
        }   
    }
    public function deleteQuestion(MQuestions $questions){
        $query="DELETE FROM questions WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$questions->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
        }  
    }
    public function addAnswer(MQuestions $questions){
        $query="insert into answer_the_questions(answer_the_questions) values ($1);";
        $array_params=array();
        $array_params[]=$questions->getAnswerTheQuestion();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблице: answer_the_questions('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблице: answer_the_questions('.pg_last_error().')'); 
        }  
    }
}
?>
