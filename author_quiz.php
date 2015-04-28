<?php
session_start();
 try{ 
     include_once 'view/checkOnPage.php';
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'lib/smarty_lib/Smarty.class.php';
//Проверяем доступ к странице
//     if(isset($_SESSION['role_user']) && !empty($_SESSION['role_user'])){
//        header('HTTP/1.1 200 OK');
//        header('Location: authorization.php');
//        exit();}
$data_quiz=array();
unset($_SESSION['new_id_quiz']);
$title="Меню администратора";
$role="Составитель теста";
$name_page='quiz';
$role_user=$_SESSION['role_user'];
rsort($role_user);

$mauthor= new MAuthorQuiz();
$mauthor->setIdUser($_SESSION['id_user']);
$author= new AuthorQuizDAO();
     
    $smarty->assign('title', $title);
    $smarty->assign('you', $you);
    $smarty->assign('name_page', $name_page);
    $smarty->assign('data_quiz',$author->getDataQuiz($mauthor));
    
    $smarty->display('templates/author_quiz.tpl');

 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
