<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/QuizDAO.php';
    Logger::configure('/etc/config_log4php.xml');
class AuthorQuizDAO  extends QuizDAO{
    protected $nameclass=__CLASS__;
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
        $array_params[]=$author->getIdUser();
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
        $query="INSERT INTO testing(id_user, id_test, mark_test)
                VALUES ($1, $2, $3);"; 
        $array_params=array();
        $array_params[]=$author->getIdUser();
        $array_params[]=$author->getIdTest();
        $array_params[]=$author->getMarkTest();
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
        $query="DELETE FROM testing WHERE id_user=$1 and id_test=$3);";
        $array_params=array();        
        $array_params[]=$author->getIdUser();
        $array_params[]=$author->getIdTest();
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
        $array_params[]=$author->getQuestionNumber();
        $array_params[]=$author->getIdQuestion();
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
