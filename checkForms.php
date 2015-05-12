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

$object_quiz_dao=new QuizDAO();
$object_user_dao=new UserDAO();
if(isset($_POST['action']) && $_POST['action']=='check'){
    if($_POST[ 'field']=="topic quiz"){
      if($object_quiz_dao->checkNameTopicQuiz($_POST['name'])){
            echo "false";
        }
        else{
            echo "true";
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
            echo "false";
        }
        else{
            echo "true";
        }  
    }
    
}
