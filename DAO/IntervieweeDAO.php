<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'model/MInterviewee.php';
include_once 'AdministrationDAO.php';
include_once 'QuizDAO.php';
include_once 'DAO/AuthorQuizDAO.php';
include_once 'log4php/Logger.php';
include_once 'DAO/TestingDAO.php';
Logger::configure(CheckOS::getConfigLogger());
class IntervieweeDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing= new TestingDAO();
    }
    // Начать тест: обновить статус теста,
    public function statusStartQuiz(MInterviewee $interviewee){
        $return=$this->testing->createTesting($interviewee, 2);
        $this->testing->setDatetimeStartTest($interviewee, date("Y-m-d H:i:s"));
        $this->setMarker($interviewee->getIdTesting(), $this->getFirstQuestion($interviewee->getTest()->getIdQuiz()));
        return $return;
    }
    //Закончить тест
    public function statusEndQuiz(MInterviewee $interviewee){
        $this->testing->editMarkTest($interviewee, 4);
        $this->testing->setDatetimeEndTest($interviewee, date("Y-m-d H:i:s"));
    }
//    // Прервать тест
//    public function interruptTheQuiz(MInterviewee $interviewee){        
//        $this->testing->editMarkTest($interviewee, 2);
//    }
    //Продолжить тест
    public function statusContinueTheQuiz(MInterviewee $interviewee){
        return $this->getMarker($interviewee);
    }
   
    // Ответить на вопрос
    public function answerTheQuestion($id_testing, $id_question, $answer_user) {
        $query="UPDATE answer_users SET answer_user=$3 where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $array_params[]=$answer_user;
        $this->db->execute($query,$array_params);
    } 
    //Вставить "маяк"(помечается вопрос на котором остановился пользователь)
    public function setMarker($id_testing, $id_question){
        if($this->checkMarker($id_testing, $id_question)){
            $query="UPDATE answer_users SET marker_quiz='latest' where id_testing=$1 and id_question=$2;";
        }
        else {
            $query="insert into answer_users(id_testing, id_question, marker_quiz) values
                ($1, $2, 'latest');"; 
        }
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        
    }
    private function checkMarker($id_testing, $id_question){
        $query="select * from answer_users where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if ($obj){
            return $obj->id_testing;
        }
        else{
            return false;
        }
    }
    //Вернуть вопрос в котором установлен маяк
    public function getMarker(MInterviewee $interviewee){
        $query="select id_question from answer_users where marker_quiz='latest' and id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_question;
    }
    //Удалить "маяк"
    public function removeMarker($id_testing, $id_question){
        $query="UPDATE answer_users SET marker_quiz=null where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $this->db->execute($query,$array_params);              
    }
    //Проверить ограничение по времени, возращает true если нет ограничений
    private function checkTimeLimit(MInterviewee $interviewee){
        $query="select time_limit from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $resurs_check_time_limit=$this->db->execute($query,$array_params);
        $result_check_time_limit= $this->db->getFetchObject($resurs_check_time_limit);
        if ($result_check_time_limit->time_limit=='null' || $result_check_time_limit->time_limit==''){
            return $result_check_time_limit->time_limit;
        }
        else {
            return $result_check_time_limit->time_limit;
        }
    }  
    //Проверить статус теста, возращает true если доступ открыт
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
    public function checkTime(MInterviewee $interviewee){
        $query="select datetime_start_test from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $datetime= $obj->datetime_start_test;
        if($datetime+$this->checkTimeLimit($interviewee)<=date("Y-m-d H:i:s")){
            return true;
        }
        else {
            return false;
        }
    }
    //Возвращает ид самого первого вопроса
    public function getFirstQuestion($id_quiz){
       $query="select min(id_question) as first_question from questions where id_test=$1;";
       $array_params=array();
       $array_params[]=$id_quiz;
       $result=$this->db->execute($query,$array_params);
       $obj=$this->db->getFetchObject($result);
       if($obj->first_question!=null){
           return $obj->first_question;
       }
       else{
           return false;
       }
   }
    ////////////////////////////////////////////////////////////////////////////
    //Возвратить инфо. о всех опроса для данного пользователя
    public function getDataTesting($id_user){
        $return=array();
        $array_testing=$this->getArrayIdTesting($id_user);
        for($i=0; $i<count($array_testing); $i++){
            $return[$i]=$this->getDataOneTesting($array_testing[$i]);        
        }        
        return $return;
    }
    public function getDataQuizTesting($id_user){
        $author_quiz=new AuthorQuizDAO();
        $return=array();
        $array_quiz=$this->getListQuiz($id_user);
        for($i=0; $i<count($array_quiz); $i++){
            $return[$i]['quiz']=$author_quiz->getListObjQuiz($array_quiz[$i]);
            if ( $this->getIdTesting($id_user, $array_quiz[$i])){
                $return[$i]['testing']=$this->getDataOneTesting($this->getIdTesting($id_user, $array_quiz[$i]));        
            }
            else{
                $return[$i]['testing']=false;
            }
        }        
        return $return;
    }
    //возвратить информацию опроса
    public function getDataOneTesting($id_testing){
        $id_quiz=$this->getObjTesting($id_testing)->id_test;
        $admin= new AdministrationDAO();
        $minterviewee=new MInterviewee();
        $quiz=new QuizDAO();
        $minterviewee->setIdTesting($id_quiz);
        $minterviewee->setUser($admin->getObjDataUser($this->getObjTesting($id_quiz)->id_user));
        $minterviewee->setTest($admin->getObjDataQuiz($this->getObjTesting($id_quiz)->id_test));
        $minterviewee->setQuestion($quiz->getObjTestQuestion($id_quiz));
        $minterviewee->setMarkTest($this->getObjTesting($id_quiz)->id_mark_test);
        $minterviewee->setDatetimeStartTest($this->getObjTesting($id_quiz)->datetime_start_test);
        $minterviewee->getDatetimeEndTest($this->getObjTesting($id_quiz)->datetime_end_test);
        return $minterviewee;
    }
    //возвратить ид всех опросов
    private function getArrayIdTesting($id_user){
        $query="select id_testing from testing where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getArrayData($result);
    }
    private function getObjTesting($id_testing){
        $query="select * from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getFetchObject($result);
    }
    //Отображаем список доступных тестов для данного пользователя
    public function getListQuiz($id_user){
        $query="select id_test from interviewees where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
//            throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
        }   
    }
    public function getIdTesting($id_user,$id_quiz){
        $query="select id_testing from testing where id_user=$1 and id_test=$2;";
        $array_params=array();
        $array_params[]=$id_user;
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query, $array_params);
        $obj= $this->db->getFetchObject($result);
        if ($obj){
            return $obj->id_testing;
        }
        else {
            return false;
        }
    } 
    }
    

