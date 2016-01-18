<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'model/MAnswer.php';
include_once 'model/MAnswerUser.php';
Logger::configure(CheckOS::getConfigLogger());
class AnswerDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing= new TestingDAO();
    }

    public function setAnswer(MAnswer $manswer){
        try {
            $query="insert into answers(id_testing, answer) values ($1, $2);"; 
            $array_params=array();
            $array_params[]=$manswer->getIdTesting();
            $array_params[]=$manswer->getAnswer();
            $result=$this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка установки таблицы answer '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getIdAnswer($id_testing) {
        try {
            $query="select max(id_answer) as id_answer from answers where id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->id_answer;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answer '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function setAnswersAndAnswerUser($id_answer, $id_answer_user) {
        try {
            $query="insert into answers_answer_user(id_answer, id_answer_user) values ($1, $2);"; 
            $array_params=array();
            $array_params[]=$id_answer;
            $array_params[]=$id_answer_user;
            $result=$this->db->executeAsync($query,$array_params);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка установки данных таблицы answers_answer_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getAnswer_user($id_testing) {
        try {
            $query="select id_answer_users, id_question, skip_answer from answer_users where id_answer_users=$1"; 
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            $manswer = new MAnswerUser();
            $manswer->setIdAnswerUsers($obj->id_answer_users);
            $manswer->setIdQuestion($obj->id_question);
            $manswer->setSkipAnswer($obj->skip_answer);
            return $manswer;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answer_users '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getArrayIdAnswer_user($id_testing) {
        try {
            $query="select id_answer_users from answer_users where id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query, $array_params);
            return $this->db->getArrayData($result);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answer_users '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getDataAnswer_user($id_testing){
        $return=array();
        $array_answer=$this->getArrayIdAnswer_user($id_testing);
        for($i=0; $i<count($array_answer); $i++){
            if(isset($array_answer[$i])){
                $return[$i]=$this->getAnswer_user($array_answer[$i]);        
            }
        }        
        return $return;
    }
    public function getAnswersForTesting($id_testing) {
        $answer_user = $this->getDataAnswer_user($id_testing);
        $result = array();
        for($i=0; $i < count($answer_user); $i++) {
            if($answer_user[$i]->getSkipAnswer() == 'Y'){
                $result[$answer_user[$i]->getIdQuestion()][0] = null;
            }
            else {
                $obj = $this->getIdAnswer_user($answer_user[$i]->getIdAnswerUsers());
                
                for($j=0;$j<count($obj);$j++) {
                    if(isset($obj[$j]) && isset($result[$answer_user[$i]->getIdQuestion()])){
                        $result[$answer_user[$i]->getIdQuestion()][count($result[$answer_user[$i]->getIdQuestion()])] = $this->getAnswer($obj[$j]);
                    }
                    else {
                        $result[$answer_user[$i]->getIdQuestion()][0] = $this->getAnswer($obj[$j]);
                    }
                }            
            }
        }
        return $result;
    }
    public function getSkipAnswer($id_testing, $id_question) {
        try {
            $query="select id_answer_users, skip_answer from answer_users where id_testing=$1 and id_question=$2;"; 
            $array_params=array();
            $array_params[]=$id_testing;
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answer_users '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getIdAnswer_user($id_answer_users) {
        try {
            $query="select id_answer from answers_answer_user where id_answer_user=$1;"; 
            $array_params=array();
            $array_params[]=$id_answer_users;
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answers_answer_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getAnswer($id_answer) {
        try {
            $query="select answer from answers where id_answer=$1;"; 
            $array_params=array();
            $array_params[]=$id_answer;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if(isset($obj->answer)){
                return $obj->answer;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения данных таблицы answers '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function deleteAAUForQuiz($id_answer_users) {
        try {
            $query="DELETE FROM answers_answer_user WHERE id_answer_user=$1;";
            $array_params=array();
            $array_params[]=$id_answer_users;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: answers_answer_user '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function deleteAnswers($id_testing) {
        try {
            $query="DELETE FROM answers WHERE id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: answers '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function deleteAnswerUsers($id_testing) {
        try {
            $query="DELETE FROM answer_users WHERE id_testing=$1;";
            $array_params=array();
            $array_params[]=$id_testing;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: answer_users '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getAnswersForQuestion($id_question) {
        try {
            $query="select id_answer_users from answer_users where id_question=$1;"; 
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка ответов для вопроса в таблице: answer_users '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function isAnswered($id_question) {
        try {
            $query="select * from answer_users where id_question=$1"; 
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result);
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка проверки на ответ '.$e->getMessage().$e->getTraceAsString());
        }
    }
}
