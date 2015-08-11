<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'model/MQuestion.php';
include_once 'DAO/QuestionDAO.php';
Logger::configure(CheckOS::getConfigLogger());
class QuizDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    
    public function createQuiz(MQuiz $quiz, MUser $author){
        $query="INSERT INTO test(topic, time_limit, comment_test, see_the_result, see_details, id_status_test, author_test, date_create)
                VALUES ($1, $2, $3, $4, $5, $6, $7, now());"; 
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
            return $this->setIdQuiz($quiz, $author);
        }        
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: test('.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблицу: test('.pg_last_error().')');
        }
    }
    public function updateQuiz(MQuiz $quiz, MUser $author){
        $query="UPDATE test SET topic=$1, time_limit=$2,"
                . " comment_test=$3, see_the_result=$4,"
                . " see_details=$5, id_status_test=$6, author_test=$7"
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
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
//            throw new Exception('Ошибка удаления строки в таблице: test('.pg_last_error().')'); 
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
//            throw new Exception('Ошибка запроса к таблице: questtest('.pg_last_error().')'); 
        }    
    }
    public function editTimeLimit(MQuiz $quiz){
        $query="UPDATE test SET time_limit=$1"
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
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        } 
    }
    public function editSeeTheResult(MQuiz $quiz){
        $query="UPDATE test SET see_the_result=$1"
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
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }  
    }
    public function editSeeDetails(MQuiz $quiz){
        $query="UPDATE test SET see_details=$1"
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
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }   
    }
    public function editStatusQuiz(MQuiz $quiz){
        $query="UPDATE test SET id_status_test=$1 where id_test=$2;";
        $array_params=array();
        $array_params[]=$quiz->getIdStatusQuiz();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }        
    }
    public function updateComment(MQuiz $quiz){
        $query="UPDATE test SET comment_test=$1"
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
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }
    }    
    public function deleteComment(MQuiz $quiz){
        $query="UPDATE test SET comment_test=null"
        . " where id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: test('.pg_last_error().')'); 
        }
    }
    public function getStatusQuiz(MQuiz $quiz){
        $query="Select id_status_test from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdQuiz();
        $result=$this->db->execute($query,$array_params);
        $obj= $this->db->getFetchObject($result);
        if($result){
            return $obj->id_status_test;            
        } 
        else{
            $this->log->ERROR('Ошибка запроса в таблице: test('.pg_last_error().')'); 
//            throw new Exception('Ошибка запроса строки в таблице: test('.pg_last_error().')'); 
        }        
    }
    public function setIdQuiz(MQuiz $quiz, MUser $author){
        $query="select id_test from test where topic=$1 and "
                . "see_the_result=$2 and see_details=$3 and id_status_test=$4 and author_test=$5;";
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getIdStatusQuiz();
        $array_params[]=$author->getIdUser();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $quiz->setIdQuiz($obj->id_test);
        return $obj->id_test;
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
    //Возращает список всех вопросов для данного теста
    public function getObjTestQuestion($id_quiz){
        $result=array();
        $array_id_question=$this->getArrayIdQuestion($id_quiz);
        for($i=0; $i<count($array_id_question); $i++){
            if(isset($array_id_question[$i])){
                $result[$i]=$this->getObjQuestions($array_id_question[$i]);
            }
        }
        return $result;
    }
    //Возращает информацию об вопросе типи MQuestion     
   public function getObjQuestions($id_question){
       $query="select * from questions where id_question=$1;";
       $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        $obj_status= $this->db->getFetchObject($result);
        $question=new QuestionDAO();
        $mquestion=new MQuestion();
        $mquestion->setIdQuestion($obj_status->id_question);
        $mquestion->setTextQuestion($obj_status->text_question);
        $mquestion->setIdQuestionsType($obj_status->id_questions_type);
        $mquestion->setAnswerOption($question->getListAnswerOptions($obj_status->id_question));
        $mquestion->setCommentQuestion($obj_status->comment_question);
        $mquestion->setQuestionNumber($obj_status->question_number);
        $mquestion->setIdTest($obj_status->id_test);
        return $mquestion;
   }
   public function getArrayIdQuestion($id_quiz){
       $query="select id_question from questions where id_test=$1;";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getArrayData($result);            
   }
   public function getVasibilityQuiz($id_quiz){
       $query="select vasibility_test from test where id_test=$1;";
       $array_params=array();
       $array_params[]=$id_quiz;
       $result_query=$this->db->execute($query, $array_params);
       $obj=$this->db->getFetchObject($result_query);
       return $obj->vasibility_test;           
   }
   public function setVasibilityQuiz($id_quiz, $status){
        $query="UPDATE test SET vasibility_test=$1 where id_test=$2;";
        $array_params[]=$status;        
        $array_params[]=$id_quiz;
        $this->db->execute($query, $array_params);
   }
   public function checkNameTopicQuiz($topic){
       $query="select id_test from test where topic=$1;";
       $array_params=array();
       $array_params[]=$topic;
       $result_query=$this->db->execute($query, $array_params);
       $obj=$this->db->getFetchObject($result_query);
       if(isset($obj->id_test)) {
        return $obj->id_test;
       }
   }
    
}
?>
