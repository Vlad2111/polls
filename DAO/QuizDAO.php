<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
Logger::configure('setting/config.xml');
class QuizDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    
    public function createQuiz(MQuiz $quiz, MUser $author){
        $query="INSERT INTO test(topic, time_limit, comment_test, see_the_result, see_details, id_status_quiz, author_test)
                VALUES ($1, $2, $3, $4, $5, $6, $7);"; 
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentQuiz();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getIdStatusQuiz();
        $array_params[]=$author->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;       //resourse    
        }        
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: test('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: test('.pg_last_error().')');
        }
    }
    public function updateQuiz(MQuiz $quiz, MUser $author){
        $query="UPDATE test SET topic=$1, time_limit=$2,"
                . " comment_test=$3, see_the_result=$4,"
                . " see_details=$5, id_status_quiz=$6, author_test=$7"
                . " where id_test=$8;";
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentQuiz();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getIdStatusQuiz();
        $array_params[]=$author->getIdUser();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }          
    }
    public function deleteQuiz(MQuiz $quiz){
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
        $query="insert into questions values($1, $2, $3, $4, $5, $6, $7);";
        $array_params=array();
        $array_params[]=$questions->getIdQuestion;
        $array_params[]=$questions->getTexts();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getIdAnswerTheQuestions();
        $array_params[]=$questions->getCommentQuestion();
        $array_params[]=$questions->getQuestionNumber();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
            //throw new Exception('Ошибка добавления строки в таблицу: questtest('.pg_last_error().')'); 
        }          
    }
    public function deleteQuizQuestion($quiz, $questions){
        $query="DELETE FROM questions WHERE id_question=$1 and id_test=$2);";
        $array_params=array();        
        $array_params[]=$questions->getIdQuestion();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки из таблицы: questtest('.pg_last_error().')'); 
            //throw new Exception('Ошибка удаления строки из таблицы: questtest('.pg_last_error().')'); 
        }         
    }
    public function getListIdQuestions(MQuiz $quiz){
        $query="select id_question from questions where id_test=$1;";
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
    public function editTimeLimit(MQuiz $quiz){
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
    public function editSeeTheResult(MQuiz $quiz){
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
    public function editSeeDetails(MQuiz $quiz){
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
    public function editStatusQuiz(MQuiz $quiz){
        $query="UPDATE test SET id_status_quiz=$1 where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getIdStatusQuiz();
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
    
    public function updateComment(MQuiz $quiz){
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
    public function deleteComment(MQuiz $quiz){
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
    public function getStatusQuiz(MQuiz $quiz){
        $query="Select id_status_quiz from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        $obj_status= $this->db->getFetchObject($result);
        if($result){
            return $obj_status->id_status_quiz;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }        
    }

   
}
?>
