<?php
session_start();
 try{
include_once 'view/checkOnPage.php';
include_once 'view/QuizView.php';
    
    //Фильтрация входных параметров. Мера предостарожности
 $id_testing=filter_input(INPUT_GET, 'testing', FILTER_SANITIZE_SPECIAL_CHARS);
 $status=filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
 $button=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
 $id_question=filter_input(INPUT_GET, 'id_question', FILTER_SANITIZE_SPECIAL_CHARS);
 $quiz=filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_SPECIAL_CHARS);
 //Проверяем параметры в сессии
if(isset($id_testing) && $id_testing!=""){
    $_SESSION['id_testing']=$id_testing;
} 
if(isset($status) && $status!=""){
    $_SESSION['status_testing']=$status;
} 
//Получаем овновные данные
$quiz_view= new QuizView($_SESSION['id_testing']);
//Работа с кнопками
if($button=="start_quiz"){
    $_SESSION['status_testing']='unfinished';
    $quiz_view->startQuiz();
	header("Location:quiz.php?status=unfinished&testing=".$_SESSION['id_testing']);
	exit;
}
elseif($button=="end_quiz"){
    $_SESSION['status_testing']='finished';
    $quiz_view->endQuiz();
	header("Location:quiz.php?status=finished&testing=".$_SESSION['id_testing']);
	exit;
}

elseif($button=="end_question"){
    $boolean = $quiz_view->answerQuestion($_POST['answer']);
    if(isset($boolean)) {
        $_SESSION['status_testing']='unfinished';
		header("Location:quiz.php?status=unfinished&testing=".$_SESSION['id_testing']);
		exit;
    }
    else {
        $_SESSION['status_testing']='finished';
        $quiz_view->endQuiz();
		header("Location:quiz.php?status=finished&testing=".$_SESSION['id_testing']);
		exit;
    }
}
elseif($button=="skip_question") {
    $boolean = $quiz_view->answerQuestion(null);
    if(isset($boolean)) {
        $_SESSION['status_testing']='unfinished';
		header("Location:quiz.php?status=unfinished&testing=".$_SESSION['id_testing']);
		exit;
    }
    else {
        $_SESSION['status_testing']='finished';
        $quiz_view->endQuiz();
		header("Location:quiz.php?status=finished&testing=".$_SESSION['id_testing']);
		exit;
    }
}
elseif($button=="skip_end_question") {
    $quiz_view->skipAllQuestions();
    $_SESSION['status_testing']='finished';
    $quiz_view->endQuiz();
	header("Location:quiz.php?status=finished&testing=".$_SESSION['id_testing']);
	exit;
}



//Работа с данными
//Представим данные в виде массива с номером вопроса и данными
$testing=new IntervieweeDAO();
$quiz = new QuizDAO();
$data_questions=$quiz_view->getArrayQuestions();
if(isset($quiz_view->data_testing)){
    $marker=$testing->getMarker($quiz_view->data_testing);
}
if(isset($marker)){
	$data_one_question=$quiz->getObjQuestions($marker);
}
else {
	$data_one_question=$quiz->getObjQuestions($data_questions[0]['data_questions']->getIdQuestion());
}


if ($_SESSION['status_testing']=='new_test'){
    $status_testing='new_testing';
}
if ($_SESSION['status_testing']=='available'){
    $status_testing='new_testing';
}
elseif ($_SESSION['status_testing']=='unfinished'){
    $status_testing='continue_testing';
}
elseif($_SESSION['status_testing']=='finished'){
    $status_testing='end_quiz';
}
$title="Прохождение тестов"; 
$smarty->assign('title', $title);
$smarty->assign("data_testing", $quiz_view->data_testing);
$smarty->assign("data_questions", $data_questions);
$smarty->assign("status_testing", $status_testing);
$smarty->assign("data_test", $quiz_view->data_test);
$smarty->assign("data_one_question", $data_one_question);
$smarty->assign("countOfAnswered", $quiz_view->countOfAnswered);
$smarty->assign("countOfQuestions", $quiz_view->countOfQuestions);
$smarty->assign("countOfAnswers", $quiz_view->countOfAnswers);
$smarty->assign("interval", $quiz_view->interval);
$smarty->assign("listOfAnswers", $quiz_view->listOfAnswers);
$smarty->assign("colors", $quiz_view->colors);
$smarty->assign("dateinterval", $quiz_view->dateinterval);
$smarty->assign('mark_rating_type', $quiz_view->getMarkOfRatingType());

$smarty->display('templates/quiz.tpl');
 }
 catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
