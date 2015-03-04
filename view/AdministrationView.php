<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('/etc/config_log4php.xml');
class AdministrationView extends AdministrationDAO{
    private $admin;
    protected $nameclass=__CLASS__;
    
    public function  addUser(MUser $user){
        $this->createUser($user);
        $this->addRole($user);
    }
    public function deleteQuiz(MQuiz $data_quiz){
        $quiz= new QuizDAO();
        $quiz->deleteQuiz($data_quiz);
    }
    

    
    

}
