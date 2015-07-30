<?php
session_start();

include_once 'view/checkOnPage.php';
include_once 'view/CreateQuizView.php'; 
include_once 'lib/ConfigFile.php';
$config_file=  ConfigFile::getInstance();
$create_quiz_view = new CreateQuizView();
// echo "<pre>";
// var_dump($create_quiz_view->getDataQuestions());
// echo "</pre>";
$smarty->assign('title', $create_quiz_view->title); 
$smarty->assign('view_quiz', $create_quiz_view->view_quiz); 
$smarty->assign('data_questions', $create_quiz_view->getDataQuestions());
$smarty->assign('data_one_question', $create_quiz_view->getOneDataQuestion());
$smarty->assign('data_answer_option', $create_quiz_view->getAnswerOptionsData());
$smarty->assign('id_question', $create_quiz_view->id_question);
$smarty->assign('data_one_quiz', $create_quiz_view->getOneDataQuiz());
$smarty->assign('users_data', $create_quiz_view->getUsers());
$smarty->assign('max_time', $config_file->array_params["ParamsDike"]["max_time"]);

$smarty->display('templates/create_quiz.tpl');

?>
