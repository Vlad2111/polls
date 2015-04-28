<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'model/MInterviewee.php';
include_once 'AdministrationDAO.php';
include_once 'QuizDAO.php';
include_once 'DAO/AuthorQuizDAO.php';
include_once 'Log4php/Logger.php';
Logger::configure(CheckOS::getConfigLogger());
class IntervieweeDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
    // Начать тест: обновить статус теста,
    public function statusStartQuiz(MInterviewee $interviewee){
        $query_update="UPDATE testing SET datetime_start_test=$1, "
                . "id_mark_test=2 where id_testing=$2 and id_mark_test=1 or id_mark_test=2;";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->getIdTesting();
        $this->createAnswerUser($interviewee);
        return $this->db->execute($query_update,$array_params);
    }
    //Закончить тест
    public function statusEndQuiz(MInterviewee $interviewee){
        $query=" UPDATE testing SET datetime_end_test=$1, "
                . "id_mark_test=4 where id_test=$2 and id_user=$3 and id_mark_test=1 or id_mark_test=2;";
        $array_params=array();
        $array_params[]=date("Y-m-d H:i:s");
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $array_params[]=$interviewee->getUser()->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: testing('.pg_last_error().')'); 
        }      
    }
    // Прервать тест
    public function interruptTheQuiz(MInterviewee $interviewee){        
        if (checkTimeLimit($interviewee)){
//            $this->setMarker($interviewee);
        }
        else {
            $this->endQuiz($interviewee);
        }

    }
    //Продолжить тест
    public function statusContinueTheQuiz(MInterviewee $interviewee){
        if ($this->checkTimeLimit($interviewee) && $this->checkMarkTest($interviewee)){
            $query="select * from answer_users where marker_quiz='latest';";
            $array_params=array();
            $array_params[]=$interviewee->getIdUser();
            $result=$this->db->execute($query,$array_params);
            if($result){
                $id_testing=$this->db->getFetchObject($result);
                return $id_testing->id_question;
            } 
            else{
                $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
//                throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
            } 
        }
        else {
            $this->statusEndQuiz($interviewee);
        }
    }
    // Ответить на вопрос
    public function answerTheQuestion(MAnswerUser $muser) {
        $muser->setIdAnswerUsers($this->getIdAnswerUser($muser->getIdTesting(), $muser->getIdQuestion()));
        if($muser->getAnswerUser()!='null' || $muser->getAnswerUser()!=''){
            $query="insert into question_answer_users(id_answer_user, answer_user) values
                    ($1,  $2);";
            $array_params=array();
            $array_params[]=$muser->getIdAnswerUsers();
            $array_params[]=$muser->getAnswerUser();
            return $this->db->execute($query,$array_params);
        }
        elseif($muser->getIdAnswerOption()!='' || $muser->getIdAnswerOption()!='null'){
            $query="insert into question_answer_users(id_answer_user, id_answer_option) values
                    ($1,  $2);";
            $array_params=array();
            $array_params[]=$muser->getIdAnswerUsers();
            $array_params[]=$muser->getIdAnswerOption();
            return $this->db->execute($query,$array_params);
        }
        else {
            return false; 
        }
    } 
    //Следующий вопрос
    public function nextQuestion(MInterviewee $interviewee){
        
    }
    //Предыдущий вопрос
    public function prevQuestion(MInterviewee $interviewee){}
    //Вставить "маяк"(помечается вопрос на котором остановился пользователь)
    public function setMarker($id_testing, $id_question){
        $query="UPDATE answer_users SET marker_quiz='latest' where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        if(!$result){
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')');        
        }          
    }
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
        $result=$this->db->execute($query,$array_params);
        if(!$result){
            $this->log->ERROR('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: answer_users ('.pg_last_error().')');        
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
    /////////////////////////////
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
    //Вернуть минимальный порядок вопросов, в данном тесте. Возращает ид вопроса
    public function getMinNumberQuestion(MInterviewee $interviewee){
        $query_qet_question="select id_question from questions where question_number=(select min(question_number) from questions) and id_test=$1;";
        $array_params_qet_question=array();
        $array_params_qet_question[]=$interviewee->getTest()->getIdQuiz();
        $result_qet_question=$this->db->execute($query_qet_question,$array_params_qet_question);
        if($result_qet_question){
                $id_questions=$this->db->getFetchObject($result_qet_question);
                return $id_questions->id_question;
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
//            throw new Exception('Ошибка запроса к таблице: questions('.pg_last_error().')'); 
        } 
    }
    private function createAnswerUser(MInterviewee $interviewee){
        $array_question=$interviewee->getQuestion();
        foreach($array_question as $key=>$value){
            $array_question[$key]->getIdQuestion();
            $query="insert into answer_users(id_testing, id_question) values 
                    ($1, $2);";
            $array_params=array();
            $array_params[]=$interviewee->getIdTesting();
            $array_params[]=$array_question[$key]->getIdQuestion();
            $result=$this->db->execute($query,$array_params); 
            if(!$result){
                $this->log->ERROR('Ошибка добавления строки в таблицу: answer_users( '.pg_last_error().')'); 
//                throw new Exception('Ошибка добавления строки в таблицу: answer_users( '.pg_last_error().')');          
            }        
        }
        return true;
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
    private function getIdAnswerUser($id_testing, $id_question){
        $query="select id_answer_user from answer_users where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query, $array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_answer_user;
    }
}

