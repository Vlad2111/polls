<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/QuizDAO.php';
    Logger::configure(CheckOS::getConfigLogger());
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
    public function getDataQuiz(MAuthorQuiz $author){
        $result=array();
        $array_id_quiz=$this->getListQuiz($author);
        for($i=0; $i<count($array_id_quiz); $i++){
            $result[$i]=$this->getListObjQuiz($array_id_quiz[$i]);
        }
        return $result;
    }
    public function addInterviewee(MAuthorQuiz $author){
        $query="insert into interviewees(id_test, id_user, group_ldap)
                VALUES ($1, $2, $3);"; 
        $array_params=array();
        $array_params[]=$author->getIdTest();
        $array_params[]=$author->getIdUser();
        $array_params[]=$author->getGroupLdap();
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
        $query="DELETE FROM interviewees WHERE id_user=$1 and id_test=$2 and group_ldap=$3;";
        $array_params=array();        
        $array_params[]=$author->getIdUser();
        $array_params[]=$author->getIdTest();
        $array_params[]=$author->getGroupLdap();
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
    public function getListObjQuiz($id_quiz){
        $query="select * from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if($result){
             return $obj;          
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: test('.pg_last_error().')'); 
        }    
    }
    public function getListQuestion($id_quiz){
        $query="select id_question from questions where id_test=$1;";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: test('.pg_last_error().')'); 
        }    
    }
    public function getListObjQuestion($id_question){
        $query="select * from questions where id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if($result){
             return $obj;          
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: test('.pg_last_error().')'); 
        }    
    }
    
    public function getDataQuestion($id_quiz){
        $result=array();
        $array_id_question=$this->getListQuestion($id_quiz);
        for($i=0; $i<count($array_id_question); $i++){
            $result[$i]=$this->getListObjQuestion($array_id_question[$i]);
        }
        return $result;
    }
    
}
?>
