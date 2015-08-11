<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'lib/CheckOS.php';
include_once 'lib/PhpLDAP.php';
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/UserDAO.php';
include_once 'model/MUser.php';
include_once 'DAO/QuestionDAO.php';
include_once 'model/MQuestion.php';
include_once 'model/MAnswerOptions.php';
include_once 'DAO/AnswerOptionsDAO.php';
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MQuestion.php';
include_once 'view/QuizView.php';
include_once 'model/MAnswerUser.php';
include_once 'DAO/TestingDAO.php';
include_once 'view/CreateQuizView.php';   

$create_quiz_view = new CreateQuizView();
$object_quiz_dao=new QuizDAO();
$object_user_dao=new UserDAO();
if(isset($_POST['action']) && $_POST['action']=='check'){
    if($_POST[ 'field']=="topic quiz"){
      if($object_quiz_dao->checkNameTopicQuiz($_POST['name'])){
            echo 0;
        }
        else{
            echo 1;
        } 
    }
    if($_POST[ 'field']=="email user"){
      if($object_user_dao->checkEmailUser($_POST['name'])){
            echo "false";
        }
        else{
            echo "true";
        }  
    }
    if($_POST[ 'field']=="login user"){
      if($object_user_dao->checkLoginUser($_POST['name'])){
            echo 1;
        }
        else{
            echo 0;
        }  
    }    
}
if(isset($_POST['action']) && $_POST['action']=='getInterviewees'){
    $user = new UserDAO();
    $data_user = $user->searchUser($_POST['value']);
    if(!empty($data_user->id_user)){
        $result['id'] = iconv("windows-1251", "utf-8", $data_user->id_user); 
        $result['name'] = trim($data_user->last_name)." ".trim($data_user->first_name); 
        $result['login'] =trim($data_user->login); 
        $result['ldap_user'] = $data_user->ldap_user;
        $res = array('status' => true, 'data' => $result);
    }
    else{
        $res = array('status' => false);
    }
    echo json_encode($res);
}
if(isset($_POST['action']) &&  $_POST['action']=='getAnswerOption'){
    echo $_POST['id_question'];
}
exit;
