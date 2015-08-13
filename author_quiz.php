<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'view/AuthorQuizView.php';
//Обнуляем переменную
//unset($_SESSION['id_quiz']);
$title="Меню автора тестов";
$author_view=new AuthorQuizView($_SESSION['id_user']);

    $smarty->assign('title', $title);
    $arr = array();
    for($i=0;$i<count($author_view->getAuthorQuizs());$i++) {
    $va = split('[/.]', $author_view->getAuthorQuizs()[$i]->getDateCreate());
    $author_view->getAuthorQuizs()[$i]->setDateCreate($va[0]);
    }
    $smarty->assign('data_quiz',$author_view->getAuthorQuizs());
    
    $smarty->display('templates/author_quiz.tpl');
 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
