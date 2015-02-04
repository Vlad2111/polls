<?php
include_once 'lib/DB.php';
include_once 'ValuesQuiz.php';
include_once 'Log4php/Logger.php';
class QuizDAO {
    private $db;
    private $log;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function createQuize($quiz){
        $query="INSERT INTO test(id_test, topic, time_limit, comment, see_the_result, see_details, status)
                VALUES ($1, '$2', '$3', '$4', '$5', '$6', '$7');"; 
        $array_params= array('$quiz->id_quize','$quiz->topic', '$quiz->time_limit', '$quiz->comment_test',
                '$quiz->see_the_result', '$quiz->see_the_details', '$quiz->status');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка добавления строки в таблицу: test'); 
            throw new Exception('Ошибка добавления строки в таблицу: test'); 
        }          
    }
    public function updateQuize($quiz){
        $query="UPDATE test SET topic='$1', time_limit='$2',"
                . " comment='$3', see_the_result='$4',"
                . " see_details='$5', status='$6'"
                . " where id_test='$7';";
        $array_params=array('$quiz->topic','$quiz->time_limit','$quiz->comment','$quiz->see_the_result',
                    '$quiz->see_details','$quiz->status','$quiz->id_quiz');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка обновления строки в таблице: test'); 
            throw new Exception('Ошибка обновления строки в таблице: test'); 
        }          
    }
    public function deleteQuize($quiz){
        $query="DELETE FROM test WHERE id_test='$quiz->id_quiz';";
        if(!$this->db->execute($query)){
            $this->log->ERROR('Ошибка удаления строки в таблице: test'); 
            throw new Exception('Ошибка удаления строки в таблице: test'); 
        }          
    }
    public function createQuestion($quiz){
        $query="INSERT INTO questions(id_question, texts, type, answer, comment)
                VALUES ($quiz->id_question, '$quiz->texts', '$quiz->type', '$quiz->answer', '$quiz->comment_question');";
        $this->db->execute($query);
//        $array_params=array($quiz->id_question, $quiz->texts, $quiz->type, $quiz->answer, $quiz->comment_question);       
//        if(!$this->db->executeParams($query,$array_params)){
//            $this->log->ERROR('Ошибка добавления строки в таблицу: questions'); 
//            throw new Exception('Ошибка добавления строки в таблицу: questions'); 
//        }  
    }
    public function updateQuestion($quiz){
        $query="UPDATE questions SET texts='$2', type='$3',"
                . " answer='$4', comment='$5',"
                . " where id_question='$1';";
        $array_params=array('$quiz->$id_question', '$quiz->texts', '$quiz->type', '$quiz->answer', '$quiz->comment_question');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка обновления строки в таблице: questions'); 
            throw new Exception('Ошибка обновления строки в таблице: questions'); 
        }   
    }
    public function deleteQuestion($quiz){
        $query="DELETE FROM questions WHERE id_question='$quiz->id_question';";
        if(!$this->db->execute($query)){
            $this->log->ERROR('Ошибка удаления строки в таблице: questions'); 
            throw new Exception('Ошибка удаления строки в таблице: questions'); 
        }  
    } 
    public function addQuestion($quiz){
         $query="insert into questtest values($1, $2);";
          $array_params=array('$quiz->id_question','$quiz->id_quize');
        if(!$this->db->execute($query,$array_params)){
            $this->log->ERROR('Ошибка добавления строки в таблицу: questtest'); 
            throw new Exception('Ошибка добавления строки в таблицу: questtest'); 
        }          
    }
}
?>
