<?php
include_once 'lib/DB.php';
include_once 'model/ValuesQuiz.php';
include_once 'Log4php/Logger.php';
class QuizDAO {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createQuiz($quiz){
        $query="INSERT INTO test(topic, time_limit, comment_test, see_the_result, see_details, status)
                VALUES ($1, $2, $3, $4, $5, $6);"; 
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentTest();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getStatus();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }        
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: test('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: test('.pg_last_error().')');
        }
    }
    public function updateQuiz($quiz){
        $query="UPDATE test SET topic='$1', time_limit='$2',"
                . " comment='$3', see_the_result='$4',"
                . " see_details='$5', status='$6'"
                . " where id_test='$7';";
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentTest();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getStatus();
        $array_params[]=$quiz->getIdQuiz();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test'); 
            throw new Exception('Ошибка обновления строки в таблице: test'); 
        }          
    }
    public function deleteQuiz($quiz){
        $query="DELETE FROM test WHERE id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
        }          
    }
    public function createQuestion($quiz){
        $array_params=array();
        $array_params[]=$quiz->getTexts();
        $array_params[]=$quiz->getType();
        $array_params[]=$quiz->getAnswer();
        $array_params[]=$quiz->getCommentQuestion();
        $query="INSERT INTO questions(texts, type, answer, comment_questions)
                VALUES ($1, $2, $3, $4);"; 
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
        }  
    }
    public function updateQuestion($quiz){
        $query="UPDATE questions SET texts=$1, type=$2,"
                . " answer=$3, comment_question=$4,"
                . " where id_question=$5;";
        $array_params=array();
        $array_params[]=$quiz->getTexts();
        $array_params[]=$quiz->getType();
        $array_params[]=$quiz->getAnswer();
        $array_params[]=$quiz->getCommentQuestion();       
        $array_params[]=$quiz->getIdQuestion();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
        }   
    }
    public function deleteQuestion($quiz){
        $query="DELETE FROM questions WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuestion();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
        }  
    } 
    public function addQuestion($quiz){
        $query="insert into questtest values($1, $2);";
        $array_params=array();
        $array_params[]=$quiz->getIdQuestion();
        $array_params[]=$quiz->getIdQuiz();
        $result=@$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
        }          
    }
    
}
?>
