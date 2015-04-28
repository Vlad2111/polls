<?php
session_start();
 try{ 
include_once 'lib/smarty_lib/Smarty.class.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'model/MInterviewee.php';
include_once 'view/QuizView.php';
 $testing=filter_input(INPUT_GET, 'testing', FILTER_SANITIZE_SPECIAL_CHARS);
 $button=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
 if (isset($testing) || $testing!=""){
     setcookie("testing", $testing);
 }
 $title="Прохождение теста ";
 $you=$_SESSION['fio_user'];
 $role_user=$_SESSION['role_user'];
     $quiz_view=new QuizView($_COOKIE['testing']);
    $data_testing=$quiz_view->getTesting();
    $mark_test=$data_testing->getMarkTest();
    $questionss=$data_testing->getQuestion();
    $question='null';
    echo "<pre>";
    var_dump($data_testing);
    echo "</pre>";
      
     if($mark_test==1){
         $status_test="start_test";
     }
     elseif($mark_test==2){
         $status_test="taking_a_test";
     }
     elseif($mark_test==4){
         $status_test="finished_test";
     }
//      
//    if($button=='start_quiz'){
//        $quiz_view->startQuiz();
//    }
//    if($button=='end'){
//        $quiz_view->endQuiz();
//    }
//    if($button=='next'){
//        $quiz_view->nextQuestion($id_question);
//    }
//    $role_user=$_SESSION['role_user'];
rsort($role_user);
// $smarty= new Smarty();
//    $smarty->assign('testing', $testing);
//    $smarty->assign('title', $title);
//    $smarty->assign('data_one_testing', $data_testing); //инстанс тестинга
//    $smarty->assign('question', $questionss[0]); //Интсанс вопроса
//    $smarty->assign('you', $you);    
//    $smarty->assign('data_role',$role_user);
//    $smarty->assign('type_answer', "1"); //ид типа вопроса
//    $smarty->assign('status_test',$status_test);
//    
//    $smarty->display('templates/quiz.tpl');
  }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
