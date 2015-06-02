<?php
session_start();
 try{
include_once 'view/checkOnPage.php';
include_once 'view/QuizView.php';
    
$data_one_question="";
    //Фильтрация входных параметров. Мера предостарожности
 $id_testing=filter_input(INPUT_GET, 'testing', FILTER_SANITIZE_SPECIAL_CHARS);
 $status=filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
 $button=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
 $id_question=filter_input(INPUT_GET, 'id_question', FILTER_SANITIZE_SPECIAL_CHARS);
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
}
elseif($button=="end_quiz"){
    $_SESSION['status_testing']='finished';
    $quiz_view->endQuiz();
}




//Работа с данными
//Представим данные в виде массива с номером вопроса и данными
$data_questions=$quiz_view->getArrayQuestions();
//Возврат данных вопроса по ид
if(isset($id_question) && $id_question!=""){
    for($i=0; $i<count($data_questions); $i++){
        if($data_questions[$i]['data_questions']->getIdQuestion()==$id_question){
            $data_one_question=$data_questions[$i];
        }
    }
}


//echo "<pre>";
//    var_dump($data_one_question);
//echo "</pre>";



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
$smarty->assign("status_testing", 'continue_testing');
$smarty->assign("data_test", $quiz_view->data_testing->getTest());
$smarty->assign("data_one_question", $data_one_question);

$smarty->display('templates/quiz.tpl');
 }
 catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
