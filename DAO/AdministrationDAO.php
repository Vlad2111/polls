<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/UserDAO.php';
include_once 'model/MQuiz.php';
include_once 'model/MUser.php';
    Logger::configure(CheckOS::getConfigLogger());    
class AdministrationDAO extends UserDAO{
    protected $nameclass=__CLASS__;
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
    //Возращает данные о тесте типа MQuiz
    public function getObjDataQuiz($id_quiz){
        $query="select * from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result_query=$this->db->execute($query, $array_params);
        $obj_quiz= $this->db->getFetchObject($result_query);
        $obj_data_quiz=new MQuiz();
        $obj_data_quiz->setIdQuiz($obj_quiz->id_test);
        $obj_data_quiz->setTopic($obj_quiz->topic);
        $obj_data_quiz->setTimeLimit($obj_quiz->time_limit);
        $obj_data_quiz->setCommentQuiz($obj_quiz->comment_test);
        $obj_data_quiz->setSeeTheResult($obj_quiz->see_the_result);
        $obj_data_quiz->setSeeDetails($obj_quiz->see_details);
        $obj_data_quiz->setIdStatusQuiz($obj_quiz->id_status_quiz);
        $obj_data_quiz->setAuthorTest($this->getObjDataUser($obj_quiz->author_test));
        return $obj_data_quiz;
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
        return $obj_data_user;
    }
    //Возращаем список доступных тестов для данного пользователя
    public function getUserAvailableTests($id_user){
        $query="select test.* from test	where 
		id_test=(select interviewees.id_test from interviewees 
			inner join all_group on interviewees.id_group=all_group.id_group
			inner join group_users on all_group.id_group=group_users.id_group
			where group_users.id_user=1);";
        $array_params=array();
        $array_params[]=$id_user;
        $result_query=$this->db->execute($query, $array_params);
        $obj_quiz= $this->db->getFetchObject($result_query);
    }    
//    //Получаем информацию о тесте: Название теста, автор теста, статус теста
//    public function getDataQuiz(){
//        $listIdQuiz=$this->getListIdQuiz();
//        $countQuiz=count($listIdQuiz);
//        $query_quiz="select topic, author_test from test where id_test=$1;";
//        $query_return_status_quiz="select description_status_quiz from status_quiz where id_status_quiz="
//                . "(select id_status_quiz from test where id_test=$1)";
//        $array_list_data_quiz=array();
//        for($i=0; $i<$countQuiz; $i++){
//            $array_params_quiz=array();
//            $array_params_quiz[]=$listIdQuiz[$i];
//            $result_quiz=$this->db->execute($query_quiz, $array_params_quiz);
//            $result_status_quiz=$this->db->execute($query_return_status_quiz, $array_params_quiz);
//            $obj_quiz= $this->db->getFetchObject($result_quiz);
//            $obj_status_quiz= $this->db->getFetchObject($result_status_quiz);
//            $array_quiz_data=array();
//            $array_quiz_data[]=$obj_quiz->topic;
//            $array_quiz_data[]=$this->getUser($obj_quiz->author_test);
//            $array_quiz_data[]=$obj_status_quiz->description_status_quiz;
//            $array_list_data_quiz[$i]=$array_quiz_data;
//            $array_list_data_quiz[$i][]=$listIdQuiz[$i];
//        }
//        return $array_list_data_quiz;
//    }
//    //Метод возвращает ФИО пользователя по id
//        public function getUser($id_Users){
//        $query_users="select * from alluser where id_user=$1;";
//        $array_params_users=array();
//        $array_params_users[]=$id_Users;
//        $result=$this->db->execute($query_users,$array_params_users);
//        $obj_users= $this->db->getFetchObject($result);
//        $array_user_data=array();
//        $array_user_data[]=$obj_users->id_user;
//        $array_user_data[]=$obj_users->first_name;
//        $array_user_data[]=$obj_users->last_name;        
//        $array_user_data[]=$obj_users->patronymic;
//        return $array_user_data; 
////        return $obj_user_data;
//    }
//    public function getRoleUser($id_Users){
//        $query_return_role_user="select description_role from role where id_role="
//                . "(select id_role from role_user where id_user=$1);";
//        $array_params_role_user=array();
//        $array_params_role_user[]=$id_Users;
//        $result=$this->db->execute($query_return_role_user,$array_params_role_user);
//        $obj_users= $this->db->getFetchObject($result);
//        $return=$obj_users->description_role;
//        return $return;
//    }
//    public function getDataOneQuiz($id_quiz){
//        $query_quiz="select topic, author_test from test where id_test=$1;";
//        $query_return_status_quiz="select description_status_quiz from status_quiz where id_status_quiz="
//                . "(select id_status_quiz from test where id_test=$1)";        
//            $array_params_quiz=array();
//            $array_params_quiz[]=$id_quiz;
//            $result_quiz=$this->db->execute($query_quiz, $array_params_quiz);
//            $result_status_quiz=$this->db->execute($query_return_status_quiz, $array_params_quiz);
//            $obj_quiz= $this->db->getFetchObject($result_quiz);
//            $obj_status_quiz= $this->db->getFetchObject($result_status_quiz);
//            $array_quiz_data=array();
//            $array_quiz_data[]=$obj_quiz->topic;
//            $array_quiz_data[]=$this->getUser($obj_quiz->author_test);
//            $array_quiz_data[]=$obj_status_quiz->description_status_quiz;    
//        return $array_quiz_data;
//    }
    
}
?>
