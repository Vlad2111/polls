<?php
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
include_once 'DAO/UserDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MQuiz.php';
    Logger::configure('setting/config.xml');
class AdministrationDAO extends UserDAO{
//    private $db;
//    private $log;
//    public function __construct(){
//        $this->db=DB::getInstance();
//        $this->log= Logger::getLogger(__CLASS__);
//    }
    public function getListQuiz(){
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
    public function getListUsers(){
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
    public function deleteQuiz($id_quiz){
        $admin= new MQuiz();
        $admin->setIdQuiz($id_quiz);
        $quiz=new QuizDAO();
        $quiz->deleteQuiz($admin);
    }
    
}
?>
