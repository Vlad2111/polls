<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'lib/DB.php';
class AdministrationView {
    private $admin;
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->admin=new AdministrationDAO();
    }
    //Метод возращает двумерный массив строк на каждого пользователя состоящий из: Фамилия, Имя, Отчество
        public function getDataUsers(){
        $listIdUsers=$this->admin->getListIdUsers();
        $countUsers=count($listIdUsers);
        $array_list_data_users=array();
        for ($i=0; $i<$countUsers; $i++){
        $array_list_data_users[$i]=$this->getFIOUser($listIdUsers[$i]);        
        }
        return $array_list_data_users;
    }
    public function getDataQuiz(){
        $listIdQuiz=$this->admin->getListIdQuiz();
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
            $array_quiz_data[]=$this->getFIOUser($obj_quiz->author_test);
            $array_quiz_data[]=$obj_status_quiz->description_status_quiz;
            $array_list_data_quiz[$i]=$array_quiz_data;
        }
        return $array_list_data_quiz;
    }
    public function getFIOUser($idUsers){
        $query_users="select last_name, first_name, patronymic from alluser where id_user=$1;";
        $array_params_users=array();
        $array_params_users[]=$idUsers;
        $result=$this->db->execute($query_users,$array_params_users);
        $obj_users= $this->db->getFetchObject($result);
        $array_user_data=array();
        $array_user_data[]=$obj_users->first_name;
        $array_user_data[]=$obj_users->last_name;        
        $array_user_data[]=$obj_users->patronymic;
        return $array_user_data;   
    }

}
