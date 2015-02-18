<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/QuizDAO.php';
    Logger::configure('setting/config.xml');
class AuthorQuizDAO  extends QuizDAO{
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger(__CLASS__);
    }
    public function getListUsers(){
        $query="select id_user from alluser";
        $array_params=array();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: alluser('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: alluser('.pg_last_error().')'); 
        }
    }
    public function getListQuiz(MAuthorQuiz $author){
        $query="select id_test from test where author_test=$1;";
        $array_params=array();
        $array_params[]=$quiz->getIdUser();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: test('.pg_last_error().')'); 
        }    
    }
    public function addInterviewee(MAuthorQuiz $author){
        $query="INSERT INTO user_role_test(id_user, id_role, id_test)
                VALUES ($1, $2, $3);"; 
        $array_params=array();
        $array_params[]=$quiz->getIdUser();
        $array_params[]=$quiz->getIdRole();
        $array_params[]=$quiz->getIdTest();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;
        }        
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: user_role_test('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: user_role_test('.pg_last_error().')');
        }
    }
    public function deleteInterviewee(MAuthorQuiz $author){
        $query="DELETE FROM user_role_test WHERE id_user=$1 and id_role=$2 and id_test=$3);";
        $array_params=array();        
        $array_params[]=$quiz->getIdUser();
        $array_params[]=$quiz->getIdRole();
        $array_params[]=$quiz->getIdTest();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки из таблицы: user_role_test('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки из таблицы: user_role_test('.pg_last_error().')'); 
        }
    }
    public function editOrderQuestions(MAuthorQuiz $author){
        $query="UPDATE questions SET question_number=$1,"
        . " where id_question=$2;";
        $array_params=array();
        $array_params[]=$quiz->getQuestionNumber();
        $array_params[]=$quiz->getIdQuestion();
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
