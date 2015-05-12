<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/UserDAO.php';
include_once 'model/MQuiz.php';
include_once 'model/MUser.php';
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
    Logger::configure(CheckOS::getConfigLogger());    
class AdministrationDAO extends UserDAO{
    protected $nameclass=__CLASS__;
    //Возращеает массив состоящий из id тестов
    public function getListIdQuiz(){
        $query="select id_test from test;";
        $array_params=array();
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: test('.pg_last_error().')'); 
            throw new Exception('Ошибка запроса к таблице: test('.pg_last_error().')'); 
        }    
    }
    //Возращеает массив состоящий из id пользователей
   public function getListIdUsers(){
        $query="select id_user from alluser;";
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
    //Метод возвращает данные типа MUser на каждого пользователя
    public function getDataUsers(){          
        $listIdUsers=$this->getListIdUsers();
        $countUsers=count($listIdUsers);
        $array_list_data_users=array();
        for ($i=0; $i<$countUsers; $i++){
        $array_list_data_users[$i]=$this->getObjDataUser($listIdUsers[$i]); 
        }
        return $array_list_data_users;
    }
    public function getDataQuizs(){          
        $listIdQuizs=$this->getListIdQuiz();
        $countQuizs=count($listIdQuizs);
        $array_list_data_quizs=array();
        for ($i=0; $i<$countQuizs; $i++){
        $array_list_data_quizs[$i]=$this->getObjDataQuiz($listIdQuizs[$i]); 
        }
        return $array_list_data_quizs;
    }
    //Возращает данные о тесте типа MQuiz
    public function getObjDataQuiz($id_quiz){
        $query="select * from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result_query=$this->db->execute($query, $array_params);
        $obj_quiz= $this->db->getFetchObject($result_query);
        if($obj_quiz){
            $obj_data_quiz=new MQuiz();
            $obj_data_quiz->setIdQuiz($obj_quiz->id_test);
            $obj_data_quiz->setTopic($obj_quiz->topic);
            $obj_data_quiz->setTimeLimit($obj_quiz->time_limit);
            $obj_data_quiz->setCommentQuiz($obj_quiz->comment_test);
            $obj_data_quiz->setSeeTheResult($obj_quiz->see_the_result);
            $obj_data_quiz->setSeeDetails($obj_quiz->see_details);
            $obj_data_quiz->setIdStatusQuiz($obj_quiz->id_status_test);
            $obj_data_quiz->setAuthorTest($this->getObjDataUser($obj_quiz->author_test));
            $obj_data_quiz->setVasibilityTest($obj_quiz->vasibility_test);
            return $obj_data_quiz;
        }
        else{
            return $obj_quiz;
        }
        
    }
    //Возращает данные о пользователе типа MUser
    public function getObjDataUser($id_user){
        $query="select * from alluser where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result_query=$this->db->execute($query, $array_params);
        $obj_quiz= $this->db->getFetchObject($result_query);
        $obj_data_user=new MUser();
        $obj_data_user->setIdUser($obj_quiz->id_user);
        $obj_data_user->setLastName($obj_quiz->last_name);
        $obj_data_user->setFirstName($obj_quiz->first_name);
        $obj_data_user->setEmail($obj_quiz->email);
        $obj_data_user->setLogin($obj_quiz->login);
        $obj_data_user->setLdapUser($obj_quiz->ldap_user);
        $obj_data_user->setUserVasibility($obj_quiz->user_vasibility);
        $auth= new AuthorizationDAO();
        $mauth=new MAuthorization();
        if($obj_quiz->ldap_user==0){
            $auth->user='db';
        }
        else{
            $auth->user='ldap';
        }
        $mauth->setLogin($obj_quiz->login);
        $obj_data_user->setRoles($auth->getRole($mauth, $obj_quiz->id_user));
        return $obj_data_user;
    }
    
    
    //Возращает список авторских тестов
    public function getTestsAuthor($id_user){
        $id_array_test=$this->getIdArrayQuiz($id_user);
        $array_result=array();
        for($i=0; $i<count($id_array_test); $i++){
            $array_result[$i]=$this->getObjTestsAuthor($id_user, $id_array_test[$i]);
        }
        return $array_result;
    }
    private function getObjTestsAuthor($id_user, $id_quiz){
        $query="select test.topic, status_test.description_status_test from test
            inner join status_test on test.id_status_test=status_test.id_status_test
            where author_test=$1 and test.id_test=$2;";
        $array_params[]=$id_user;
        $array_params[]=$id_quiz;
        $result_query=$this->db->execute($query, $array_params);
        return $this->db->getFetchObject($result_query);
    }
    private function getIdArrayQuiz($id_user){
        $query="select id_test from test where author_test=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query,$array_params);        
        return $this->db->getArrayData($result);        
    }
    
    //Возращает список активированных тестов
    public function getTestingUser($id_user){
        $id_array_testing=$this->getIdArrayTesting($id_user);
        $array_result=array();
        for($i=0; $i<count($id_array_testing); $i++){
            $array_result[$i]=$this->getObjTestingUser($id_user, $id_array_testing[$i]);
        }
        return $array_result;
    }
    public function getObjTestingUser($id_user, $id_testing){
        $query="select test.topic, mark_test.description_mark_test from testing 
            inner join test on testing.id_test=test.id_test
            inner join mark_test on testing.id_mark_test=mark_test.id_mark_test
            where testing.id_user=$1 and testing.id_testing=$2;";
        $array_params[]=$id_user;
        $array_params[]=$id_testing;
        $result_query=$this->db->execute($query, $array_params);
        return $this->db->getFetchObject($result_query);
    }
    public function getIdArrayTesting($id_user){
        $query="select id_testing from testing where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query,$array_params);        
        return $this->db->getArrayData($result);
    }
    public function getStatusUser($id_user){
        $query="select * from alluser where id_user=$1;";
        $array_params[]=$id_user;
        $result_query=$this->db->execute($query, $array_params);
        $obj=$this->db->getFetchObject($result_query);
        return $obj->user_vasibility;
    }
    public function setStatusUser($id_user, $status){
        $query="UPDATE alluser SET user_vasibility=$1 where id_user=$2;";
        $array_params[]=$status;        
        $array_params[]=$id_user;
        $this->db->execute($query, $array_params);
    }
    
}
?>
