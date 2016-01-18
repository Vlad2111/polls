<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'model/MQuestion.php';
include_once 'model/MQuiz.php';
include_once 'DAO/QuestionDAO.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'DAO/TestingDAO.php';
include_once 'DAO/AnswerDAO.php';
include_once 'DAO/AnswerOptionsDAO.php';
Logger::configure(CheckOS::getConfigLogger());
class QuizDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    
    public function createQuiz(MQuiz $quiz, MUser $author) {
        try {
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
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $this->setIdQuiz($quiz, $author);
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function updateQuiz(MQuiz $quiz) {
        try {
            $query="UPDATE test SET topic=$1, time_limit=$2, comment_test=$3, see_the_result=$4, see_details=$5, id_status_test=$6 where id_test=$7";
            $array_params=array();
            $array_params[]=$quiz->getTopic();
            $array_params[]=$quiz->getTimeLimit();
            $array_params[]=$quiz->getCommentQuiz();
            $array_params[]=$quiz->getSeeTheResult();
            $array_params[]=$quiz->getSeeDetails();
            $array_params[]=$quiz->getIdStatusQuiz();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $quiz->getIdQuiz();            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        }   
    }
    public function deleteQuiz(MQuiz $quiz) {
        try {
            $query="DELETE FROM test WHERE id_test=$1;";
            $array_params=array();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        }         
    }    
    public function getListIdQuestions(MQuiz $quiz) {
        try {
            $query="select id_question from questions where id_test=$1;";
            $array_params=array();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                 return $this->db->getArrayData($result);            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }    
    }
    public function editTimeLimit(MQuiz $quiz) {
        try {
            $query="UPDATE test SET time_limit=$1"
                    . " where id_test=$2;";
            $array_params=array();
            $array_params[]=$quiz->getTimeLimit();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function editSeeTheResult(MQuiz $quiz) {
        try {
            $query="UPDATE test SET see_the_result=$1"
                . " where id_test=$2;";
            $array_params=array();
            $array_params[]=$quiz->getSeeTheResult();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function editSeeDetails(MQuiz $quiz) {
        try {
            $query="UPDATE test SET see_details=$1"
            . " where id_test=$2;";
            $array_params=array();
            $array_params[]=$quiz->getSeeDetails();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function editStatusQuiz(MQuiz $quiz) {
        try {
            $query="UPDATE test SET id_status_test=$1 where id_test=$2;";
            $array_params=array();
            $array_params[]=$quiz->getIdStatusQuiz();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            } 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        }       
    }
    public function updateComment(MQuiz $quiz) {
        try {
            $query="UPDATE test SET comment_test=$1"
            . " where id_test=$2;";
            $array_params=array();
            $array_params[]=$quiz->getCommentQuiz();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }    
    public function deleteComment(MQuiz $quiz) {
        try {
            $query="UPDATE test SET comment_test=null"
            . " where id_test=$1;";
            $array_params=array();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getStatusQuiz(MQuiz $quiz) {
        try {
            $query="Select id_status_test from test where id_test=$1;";
            $array_params=array();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            $obj= $this->db->getFetchObject($result);
            if($result){
                return $obj->id_status_test;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса в таблице: test '.$e->getMessage().$e->getTraceAsString());
        }        
    }
    public function setIdQuiz(MQuiz $quiz, MUser $author) {
        try {
            $query="select id_test from test where topic=$1 and "
                    . "see_the_result=$2 and see_details=$3 and id_status_test=$4 and author_test=$5;";
            $array_params=array();
            $array_params[]=$quiz->getTopic();
            $array_params[]=$quiz->getSeeTheResult();
            $array_params[]=$quiz->getSeeDetails();
            $array_params[]=$quiz->getIdStatusQuiz();
            $array_params[]=$author->getIdUser();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            $quiz->setIdQuiz($obj->id_test);
            return $obj->id_test;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса в таблице: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }   
        
    public function addQuestion($quiz, $questions) {
        try {
            $query="insert into questions values($1, $2, $3, $4, $5, $6, $7);";
            $array_params=array();
            $array_params[]=$questions->getIdQuestion;
            $array_params[]=$questions->getTexts();
            $array_params[]=$questions->getIdQuestionsType();
            $array_params[]=$questions->getIdAnswerTheQuestions();
            $array_params[]=$questions->getCommentQuestion();
            $array_params[]=$questions->getQuestionNumber();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions '.$e->getMessage().$e->getTraceAsString());
        }        
    }
    public function deleteQuizQuestion($quiz, $questions) {
        try {
            $query="DELETE FROM questions WHERE id_question=$1 and id_test=$2);";
            $array_params=array();        
            $array_params[]=$questions->getIdQuestion();
            $array_params[]=$quiz->getIdQuiz();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки из таблицы: questions '.$e->getMessage().$e->getTraceAsString());
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
    public function getObjQuestions($id_question) {
        try {
            $query="select * from questions where id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            $obj_status= $this->db->getFetchObject($result);
            $question=new QuestionDAO();
            $mquestion=new MQuestion();
            $mquestion->setIdQuestion($obj_status->id_question);
            $mquestion->setTextQuestion($obj_status->text_question);
            $mquestion->setIdQuestionsType($obj_status->id_questions_type);
            $mquestion->setAnswerOption($question->getListAnswerOptions($obj_status->id_question));
            $mquestion->setCommentQuestion($obj_status->comment_question);
            $mquestion->setQuestionNumber($obj_status->question_number);
            $mquestion->setShowChart($obj_status->show_chart);
            $mquestion->setIdTest($obj_status->id_test);
            return $mquestion;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: questions '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getArrayIdQuestion($id_quiz) {
        try {
            $query="select id_question from questions where id_test=$1 order by question_number;";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query, $array_params);
            return $this->db->getArrayData($result); 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: questions '.$e->getMessage().$e->getTraceAsString());
        }           
    }
    public function getVasibilityQuiz($id_quiz) {
        try {
            $query="select vasibility_test from test where id_test=$1;";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result_query=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result_query);
            return $obj->vasibility_test;   
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        }         
    }
    public function setVasibilityQuiz($id_quiz, $status) {
       try {
            $query="UPDATE test SET vasibility_test=$1 where id_test=$2;";
            $array_params[]=$status;        
            $array_params[]=$id_quiz;
            $this->db->executeAsync($query, $array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function checkNameTopicQuiz($topic) {
        try {
            $query="select id_test from test where topic=$1;";
            $array_params=array();
            $array_params[]=$topic;
            $result_query=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result_query);
            if(isset($obj->id_test)) {
                return $obj->id_test;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка проверки строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
   public function getMarkOfRatingType() {
       try {
            $ids = $this->getIdsOfRatingType();
            $arr = array();
            foreach($ids as $idm) {
                foreach($idm as $id){
                    for($i=0;$i<count($id);$i++) {
                        $query="select * from mark_type_rating where id=$1";
                        $array_params=array();
                        $array_params[]=$id[$i];
                        $result=$this->db->executeAsync($query, $array_params);
                        $obj = $this->db->getFetchObject($result);
                        $arr[$obj->option][]=$obj;
                    }
                }
            }
            return $arr;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        } 
    }
   public function getTypesOfRatingType() {
       try {
            $query="select option from mark_type_rating GROUP BY option";
            $result = $this->db->executeAsync($query);
            $obj=$this->db->getArrayData($result);
            return $obj;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        } 
    } 
    public function getIdsOfRatingType() {
        try {
            $count = $this->getTypesOfRatingType();
            $arr = array();
            foreach($count as $i) {
                $query="select id from mark_type_rating where option=$1 order by id";
                $array_params=array();
                $array_params[]=$i;
                $result = $this->db->executeAsync($query,$array_params);
                $obj=$this->db->getArrayData($result);
                $arr[$i][] = $obj;
            }
            return $arr;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения строки из таблицы: test '.$e->getMessage().$e->getTraceAsString());
        } 
  }
   public function deleteCascadeQuiz($id_quiz) {
        $IntervieweeDAO = new IntervieweeDAO();
        $TestingDAO = new TestingDAO();
        $AnswerDAO = new AnswerDAO();
        $AnswerOptionsDAO = new AnswerOptionsDAO();
        $QuestionDAO = new QuestionDAO();
        $MQuestion = new MQuestion();
        $IntervieweeDAO->deleteForQuiz($id_quiz);
        $testingArray = $TestingDAO->getIdTestingForQuiz($id_quiz);
        if(isset($testingArray[0])){
            foreach($testingArray as $ta){
                $arrayAnswer = $AnswerDAO->getArrayIdAnswer_user($ta);
                if(isset($arrayAnswer[0])){
                    foreach($arrayAnswer as $aa){
                        $AnswerDAO->deleteAAUForQuiz($aa);
                    }
                    $AnswerDAO->deleteAnswers($ta);
                    $AnswerDAO->deleteAnswerUsers($ta);
                }
            }
        }
        $TestingDAO->deleteForQuiz($id_quiz);
        $questionsArray = $this->getArrayIdQuestion($id_quiz);
        if(isset($questionsArray[0])){
            foreach($questionsArray as $qa){
                $AnswerOptionsDAO->deleteAnswerOptionsForQuestion($qa);
                $MQuestion->setIdQuestion($qa);
                $QuestionDAO->deleteQuestion($MQuestion);  
            }
        }
        $Mquiz = new MQuiz();
        $Mquiz->setIdQuiz($id_quiz);
        $this->deleteQuiz($Mquiz);
    }
   
}
?>
