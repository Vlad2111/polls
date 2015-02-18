<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
Logger::configure('setting/config.xml');
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
        $array_params[]=$quiz->getCommentQuiz();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getStatus();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;       //resourse    
        }        
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: test('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: test('.pg_last_error().')');
        }
    }
    public function updateQuiz($quiz){
        $query="UPDATE test SET topic=$1, time_limit=$2,"
                . " comment_test=$3, see_the_result=$4,"
                . " see_details=$5, id_status=$6"
                . " where id_test=$7;";
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentQuiz();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getStatus();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }          
    }
    public function deleteQuiz($quiz){
        $query="DELETE FROM test WHERE id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            
                    echo $this->db->getAffectedRows($result);
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
        }          
    }    
    public function addQuestion($quiz, $questions){
        $query="insert into questtest values($1, $2);";
        $array_params=array();
        $array_params[]=$quiz->getIdQuestion();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
        }          
    }
    public function deleteQuizQuestion($quiz, $questions){
        $query="DELETE FROM questtest WHERE id_test=$1 and id_question=$2);";
        $array_params=array();        
        $array_params[]=$quiz->getIdQuiz();
        $array_params[]=$quiz->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки из таблицы: questtest('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки из таблицы: questtest('.pg_last_error().')'); 
        }         
    }
    public function getListIdQuestions($quiz){
        $query="select id_question from questtest where id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: questtest('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: questtest('.pg_last_error().')'); 
        }    
    }
    public function editTimeLimit($quiz){
        $query="UPDATE test SET time_limit=$1,"
                . " where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        } 
    }
    public function editSeeTheResult($quiz){
        $query="UPDATE test SET see_the_result=$1,"
            . " where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }  
    }
    public function editSeeDetails($quiz){
        $query="UPDATE test SET see_details=$1,"
        . " where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }   
    }
    public function editStatusQuiz($quiz){
        $query="UPDATE test SET author_test=$1,"
        . " where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getAuthorTest();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }        
    }
    
    public function updateComment($quiz){
        $query="UPDATE test SET comment_test=$1,"
        . " where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getCommentQuiz();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }
    }    
    public function deleteComment($quiz){
        $query="UPDATE test SET comment_test=null,"
        . " where id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }
    }
   
}
?>
