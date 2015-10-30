<?php
session_start();

include_once 'view/checkOnPage.php';
include_once 'view/CreateQuizView.php'; 
include_once 'lib/ConfigFile.php';
include_once 'DAO/UserDAO.php';
$config_file=  ConfigFile::getInstance();
$create_quiz_view = new CreateQuizView();
$userDAO = new UserDAO();
// echo "<pre>";
// var_dump($create_quiz_view->getDataQuestions());
// echo "</pre>";
$smarty->assign('title', $create_quiz_view->title); 
$smarty->assign('view_quiz', $create_quiz_view->view_quiz); 
$smarty->assign('data_questions', $create_quiz_view->getDataQuestions());
$smarty->assign('questions', $data_questions=$create_quiz_view->getArrayQuestions());
$smarty->assign('data_one_question', $create_quiz_view->getOneDataQuestion());
$smarty->assign('data_answer_option', $create_quiz_view->getAnswerOptionsData());
$smarty->assign('id_question', $create_quiz_view->id_question);
$smarty->assign('data_one_quiz', $create_quiz_view->getOneDataQuiz());
if(isset($create_quiz_view->getOneDataQuiz()->time_limit)){
    $smarty->assign('time_array', split( ":", $create_quiz_view->getOneDataQuiz()->time_limit, -1));
}
$smarty->assign('mark_rating_type', $create_quiz_view->getMarkOfRatingType());
$smarty->assign('users_data', $create_quiz_view->getUsers());
$smarty->assign('max_time', $config_file->array_params["ParamsDike"]["max_time"]);
if(isset($_SESSION['rowcheckboxes'])){
    $smarty->assign('mails', $_SESSION['rowcheckboxes']);
}
if(isset($_SESSION['head'])){
    $smarty->assign('subject', $_SESSION['head']);
}
if(isset($_SESSION['testOfMale'])){
    $smarty->assign('message', $_SESSION['testOfMale']);
}
$smarty->assign('emailFrom', $userDAO->getUserById($_SESSION['id_user']));
$smarty->assign('countOfAnswersAboutAllUsers', $create_quiz_view->countOfAnswersAboutAllUsers);

$smarty->display('templates/create_quiz.tpl');

?>
