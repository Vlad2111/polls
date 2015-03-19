<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/UserDAO.php';
include_once 'DAO/QuizDAO.php';
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
//    public function deleteQuiz($id_quiz){
//        $admin= new MQuiz();
//        $admin->setIdQuiz($id_quiz);
//        $quiz=new QuizDAO();
//        $quiz->deleteQuiz($admin);
//    }
    //Метод возвращает двумерный массив строк на каждого пользователя состоящий из: Фамилия, Имя, Отчество
    public function getDataUsers(){          
        $listIdUsers=$this->getListIdUsers();
        $countUsers=count($listIdUsers);
        $array_list_data_users=array();
        for ($i=0; $i<$countUsers; $i++){
        $array_list_data_users[$i]=$this->getUser($listIdUsers[$i]); 
        $array_list_data_users[$i][]=$this->getRoleUser($listIdUsers[$i]);
        }
        return $array_list_data_users;
    }
    //Получаем информацию о тесте: Название теста, автор теста, статус теста
    public function getDataQuiz(){
        $listIdQuiz=$this->getListIdQuiz();
        $countQuiz=count($listIdQuiz);
        $query_quiz="select topic, author_test from test where id_test=$1;";
        $query_return_status_quiz="select description_status_quiz from status_quiz where id_status_quiz="
                . "(select id_status_quiz from test where id_test=$1)";
        $array_list_data_quiz=array();
        for($i=0; $i<$countQuiz; $i++){
            $array_params_quiz=array();
            $array_params_quiz[]=$listIdQuiz[$i];
            $result_quiz=$this->db->execute($query_quiz, $array_params_quiz);
            $result_status_quiz=$this->db->execute($query_return_status_quiz, $array_params_quiz);
            $obj_quiz= $this->db->getFetchObject($result_quiz);
            $obj_status_quiz= $this->db->getFetchObject($result_status_quiz);
            $array_quiz_data=array();
            $array_quiz_data[]=$obj_quiz->topic;
            $array_quiz_data[]=$this->getUser($obj_quiz->author_test);
            $array_quiz_data[]=$obj_status_quiz->description_status_quiz;
            $array_list_data_quiz[$i]=$array_quiz_data;
            $array_list_data_quiz[$i][]=$listIdQuiz[$i];
        }
        return $array_list_data_quiz;
    }
    //Метод возвращает ФИО пользователя по id
        public function getUser($id_Users){
        $query_users="select * from alluser where id_user=$1;";
        $array_params_users=array();
        $array_params_users[]=$id_Users;
        $result=$this->db->execute($query_users,$array_params_users);
        $obj_users= $this->db->getFetchObject($result);
//        $obj_user_data=new MUser();
//        $obj_user_data->setIdUser($obj_users->id_user);
//        $obj_user_data->setLastName($obj_users->last_name);
//        $obj_user_data->setFirstName($obj_users->first_name);
//        $obj_user_data->setPatronymic($obj_users->patronymic);
//        $obj_user_data->setEmail($obj_users->email);
//        $obj_user_data->setLogin($obj_users->login);
        $array_user_data=array();
        $array_user_data[]=$obj_users->id_user;
        $array_user_data[]=$obj_users->first_name;
        $array_user_data[]=$obj_users->last_name;        
        $array_user_data[]=$obj_users->patronymic;
        return $array_user_data; 
//        return $obj_user_data;
    }
    public function getRoleUser($id_Users){
        $query_return_role_user="select description_role from role where id_role="
                . "(select id_role from role_user where id_user=$1);";
        $array_params_role_user=array();
        $array_params_role_user[]=$id_Users;
        $result=$this->db->execute($query_return_role_user,$array_params_role_user);
        $obj_users= $this->db->getFetchObject($result);
        $return=$obj_users->description_role;
        return $return;
    }
    
    public function getDataOneQuiz($id_quiz){
        $query_quiz="select topic, author_test from test where id_test=$1;";
        $query_return_status_quiz="select description_status_quiz from status_quiz where id_status_quiz="
                . "(select id_status_quiz from test where id_test=$1)";        
            $array_params_quiz=array();
            $array_params_quiz[]=$id_quiz;
            $result_quiz=$this->db->execute($query_quiz, $array_params_quiz);
            $result_status_quiz=$this->db->execute($query_return_status_quiz, $array_params_quiz);
            $obj_quiz= $this->db->getFetchObject($result_quiz);
            $obj_status_quiz= $this->db->getFetchObject($result_status_quiz);
            $array_quiz_data=array();
            $array_quiz_data[]=$obj_quiz->topic;
            $array_quiz_data[]=$this->getUser($obj_quiz->author_test);
            $array_quiz_data[]=$obj_status_quiz->description_status_quiz;        
        return $array_quiz_data;
    }
    
}
?>
