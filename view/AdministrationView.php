<?php
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
class AdministrationView{
    private $admin;
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->admin= new AdministrationDAO();
    }
    
    public function  addUser(MUser $user){
        $this->admin->createUser($user);
        $this->admin->addRole($user);
    }
    public function deleteQuiz(MQuiz $data_quiz){
        $quiz= new QuizDAO();
        $quiz->deleteQuiz($data_quiz);
    }
    
    
    
    public function menu($link_click){
        if ($link_click==='show_users'){    
            return 'table_users';
            
        }
        elseif ($link_click==='show_quiz'){    
            return 'table_quiz';
        }
    }
    
    public function click($button_click){
    if ($button_click==='new_user'){    
            $view_admin='create_user';
        }
        
        elseif ($button_click==='return_tables_quiz'){    
            $view_admin='table_quiz';
        }
        elseif ($button_click==='select_quiz'){
        if ($button_click==='delete_quiz'){
        $mquiz=new MQuiz();
        $mquiz->setIdQuiz($_REQUEST['id_delete_quiz']);
            $quiz= new QuizDAO();
            $quiz->deleteQuiz($mquiz);
        $view_admin='table_quiz';    
        }   }    
        
    }
    public function newUser(){
        if (isset($last_name) && !empty($last_name) &&
        isset($first_name) && !empty($first_name) &&   
        isset($patronymic) && !empty($patronymic) &&
        isset($role) && !empty($role)){    
            $user=new MUser();
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setPatronymic($patronymic);
            $user->setIdRole($role);
            $user->setEmail($email);
            $user->setLogin($login);
            $user->setPassword($password);
            $administration_view->addUser($user);
            $create_user_fio=$last_name." ".$first_name." ".$patronymic;
            $view_admin='create_user_info';
        }        
    }

    
    

}
