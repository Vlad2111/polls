<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
Logger::configure('setting/config.xml');
class IntervieweeDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    //Отображаем список тестов для данного пользователя
    public function getListQuiz(MInterviewee $interviewee){
        $query="select id_test from testing where id_user=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
        }   
    }
    // Начать тест
    public function startQuiz(MInterviewee $interviewee){
        $query_update="UPDATE testing SET datetime_start_test=$1, "
                . "mark_test='unfinished' where id_test=$2 and id_user=$3 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->getIdTest();
        $array_params[]=$interviewee->getIdUser();
        $this->db->execute($query_update,$array_params);
        $this->getMinNumberQuestion($interviewee);
        $query_qet_question="select id_question from questions where question_number=(select min(question_number) from questions);";
        $array_params_qet_question=array();
        $result_qet_question=$this->db->execute($query_qet_question,$array_params_qet_question);
        if($result_qet_question){
                $id_questions=$this->db->getFetchObject($result_qet_question);
                return $id_questions->id_question;
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
        }   
    }
    //Закончить тест
    public function endQuiz(MInterviewee $interviewee){
        $query=" UPDATE testing SET datetime_end_test=$1, "
                . "mark_test='not available' where id_test=$2 and id_user=$3 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->getIdTest();
        $array_params[]=$interviewee->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
        }      
    }
    // Прервать тест
    public function interruptTheQuiz(MInterviewee $interviewee){        
        if (checkTimeLimit($interviewee)){
            $this->setMarker($interviewee);
        }
        else {
            $this->endQuiz($interviewee);
        }

    }
    //Продолжить тест
    public function continueTheQuiz(MInterviewee $interviewee){
        if (checkTimeLimit($interviewee) && checkMarkTest($interviewee)){
            $query="select id_testing from answer_users where marker_quiz='latest';";
            $array_params=array();
            $array_params[]=$interviewee->getIdUser();
            $result=$this->db->execute($query,$array_params);
            if($result){
                $id_testing=$this->db->getFetchObject($result);
                return $id_testing->marker_quiz;
            } 
            else{
                $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
                throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
            }   
            
        }
        else {
            $this->endQuiz($interviewee);
        }
    }
    // Ответить на вопрос
    public function answerTheQuestion(MInterviewee $interviewee) {
        
    } 
    //Следующий вопрос
    public function nextQuestion(MInterviewee $interviewee){
        
    }
    //Предыдущий вопрос
    public function prevQuestion(MInterviewee $interviewee){}
    //Вставить "маяк"(помечается вопрос на котором остановился пользователь)
    private function setMarker(MInterviewee $interviewee){
        $query="UPDATE answer_users SET marker_quiz='latest' where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $array_params[]=$interviewee->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if(!$result){
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')');        
        }          
    }
    //Удалить "маяк"
    private function RemoveMarker(MInterviewee $interviewee){
        $query="UPDATE answer_users SET marker_quiz=null where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $array_params[]=$interviewee->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if(!$result){
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')');        
        }          
    }
    //Проверить ограничение по времени
    private function checkTimeLimit(MInterviewee $interviewee){
        $query="select time_limit from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTest();
        $resurs_check_time_limit=$this->db->execute($query,$array_params);
        $result_check_time_limit= $this->db->getFetchObject($resurs_check_time_limit);
        if ($result_check_time_limit->time_limit=='null' || $result_check_time_limit->time_limit==''){
            return true;
        }
        else {
            return false;
        }
    }  
    //Проверить статус теста
    private function checkMarkTest(MInterviewee $interviewee){
        $query="select id_user from testing where id_testing=$1 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $resurs_check_time_limit=$this->db->execute($query,$array_params);
        $result_check_time_limit= $this->db->getArrayData($resurs_check_time_limit);
        if (count($result_check_time_limit)>0){
            return true;
        }
        else {
            return false;
        }
    }  
    //Вернуть минимальное порядок вопросов, в данном тесте
    private function getMinNumberQuestion(MInterviewee $interviewee){        
        $query_min_number_query="select min(question_number) from questions;";
        $array_params_min_number_query=array();
        $result_min_number_query=$this->db->execute($query_min_number_query,$array_params_min_number_query);
        if($result_min_number_query){
                $min_number_questions=$this->db->getFetchObject($result_min_number_query);
                $interviewee->setQuestionNumber($min_number_questions->question_number);
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
        }   
        
    }
    
}

