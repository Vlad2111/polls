<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'DAO/IntervieweeDAO.php';
$inter=new IntervieweeDAO();
$data_quiz=$inter->getDataQuizTesting($_SESSION['id_user']);
$title="Меню администратора"; 
$smarty->assign('title', $title);
$count=0;
foreach($data_quiz as $data_one_quiz) {
    if(isset($data_one_quiz['quiz']->id_status_test) && $data_one_quiz['quiz']->id_status_test == 2) {
        $count++;
    }
}
$smarty->assign("count", $count);
$smarty->assign("data_quiz", $data_quiz);
$smarty->display('templates/main.tpl');
 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
