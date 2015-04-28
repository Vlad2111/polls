<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'DAO/IntervieweeDAO.php';
$inter=new IntervieweeDAO();
$data_quiz=$inter->getDataQuizTesting($_SESSION['id_user']);
$title="Меню администратора"; 
$smarty->assign('title', $title);
$smarty->assign("data_quiz", $data_quiz);
$smarty->display('templates/main.tpl');
 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
