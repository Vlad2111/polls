<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'DAO/QuizDAO.php';
include_once 'DAO/AnswerDAO.php';
include_once 'model/MQuiz.php';
include_once 'model/MUser.php';
    Logger::configure(CheckOS::getConfigLogger());
class AuthorQuizDAO  extends QuizDAO{
    protected $nameclass=__CLASS__;
    public function getListUsers() {
        try {
            $query="select id_user from alluser";
            $array_params=array();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                 return $this->db->getArrayData($result);            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getListQuiz(MAuthorQuiz $author) {
        try {
            $query="select id_test from test where author_test=$1;";
            $array_params=array();
            $array_params[]=$author->getIdUser();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                 return $this->db->getArrayData($result);            
            }  
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: test '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getDataQuiz(MAuthorQuiz $author){
        $result=array();
        $array_id_quiz=$this->getListQuiz($author);
        for($i=0; $i<count($array_id_quiz); $i++){
            $result[$i]=$this->getListObjQuiz($array_id_quiz[$i]);
        }
        return $result;
    }
    public function addInterviewee(MAuthorQuiz $author) {
        try {
            $query="insert into interviewees(id_test, id_user, group_ldap)
                    VALUES ($1, $2, $3);"; 
            $array_params=array();
            $array_params[]=$author->getIdTest();
            $array_params[]=$author->getIdUser();
            $array_params[]=$author->getGroupLdap();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: interviewees '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    //unused
    public function deleteInterviewee(MAuthorQuiz $author){
        try {
            $query="DELETE FROM interviewees WHERE id_user=$1 and id_test=$2 and group_ldap=$3;";
            $array_params=array();        
            $array_params[]=$author->getIdUser();
            $array_params[]=$author->getIdTest();
            $array_params[]=$author->getGroupLdap();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            } 
        }
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки из таблицы: interviewees '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function editOrderQuestions(MAuthorQuiz $author) {
        try {
            $query="UPDATE questions SET question_number=$1,"
            . " where id_question=$2;";
            $array_params=array();
            $array_params[]=$author->getQuestionNumber();
            $array_params[]=$author->getIdQuestion();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }   
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getListObjQuiz($id_quiz) {
        try {
            $query="select * from test where id_test=$1;";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if($result){
                 return $obj;          
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: test '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getListQuestion($id_quiz){
        try {
            $query="select id_question from questions where id_test=$1 order by question_number ;";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                 return $this->db->getArrayData($result);            
            } 
        }
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    public function getListObjQuestion($id_question) {
        try {
            $query="select * from questions where id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            if($result){
                $answerDAO = new AnswerDAO();
                if(isset($obj->id_question)){
                    $obj->isAnswered = $answerDAO->isAnswered($obj->id_question);
                    return $obj;    
                }      
            }
        }
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }    
    }
    
    public function getDataQuestions($id_quiz){
        $result=array();
        $array_id_question=$this->getListQuestion($id_quiz);
        for($i=0; $i<count($array_id_question); $i++){
            $result[$i]=$this->getListObjQuestion($array_id_question[$i]);
        }
        return $result;
    }
    
    public function getTestingUsers($id_test) {
        try {
            $query="select id_user from interviewees where id_test=$1;";
            $array_params=array();
            $array_params[]=$id_test;
            $result=$this->db->executeAsync($query, $array_params);
            $arr = $this->db->getArrayData($result); 
            return $arr;
        }
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: interviewees '.$e->getMessage().$e->getTraceAsString());
        } 
    }
    public function getUserData($id_user) {
        try {
            $query="select * from alluser where id_user=$1;";
            $array_params=array();
            $array_params[]=$id_user;
            $result=$this->db->executeAsync($query, $array_params);
            $arr = $this->db->getFetchObject($result); 
            return $arr;
        }
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка запроса к таблице: alluser '.$e->getMessage().$e->getTraceAsString());
        } 
    }
}
?>
