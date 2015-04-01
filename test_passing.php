<?php
session_start();
 try{ 
include_once 'lib/smarty_lib/Smarty.class.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'model/MInterviewee.php';
 $testing=filter_input(INPUT_GET, 'testing', FILTER_SANITIZE_SPECIAL_CHARS);
 $action_test=filter_input(INPUT_GET, 'status_test', FILTER_SANITIZE_SPECIAL_CHARS);
 $title="Прохождение теста ";
 $you=$_SESSION['fio_user'];
 $role_user=$_SESSION['role_user'];

 $interviewee=new IntervieweeDAO();
     $user_testing=$interviewee->getDataTesting($testing);
     $temp_testing=$user_testing[0];
     $questions=$temp_testing->getQuestion();
     $question=$questions[0];
     $mark_test=$temp_testing->getMarkTest();
      
     if($action_test=="start"){
         $interviewee->startQuiz($temp_testing);
     }
     
     if($mark_test=='available'){
         $status_test="start_test";
     }
     elseif($mark_test=='unfinished'){
         $status_test="taking_a_test";
     }
     elseif($mark_test=='finished'){
         $status_test="finished_test";
     }
     else {
         header('HTTP/1.1 200 OK');
        header('Location: quiz.php');
     }
     
 $smarty= new Smarty();

    $smarty->assign('title', $title);
    $smarty->assign('temp_testing', $temp_testing);
    $smarty->assign('question', $question);
    $smarty->assign('you', $you);    
    $smarty->assign('role_user',$role_user);
    $smarty->assign('type_answer', "4");
    $smarty->assign('status_test', $status_test);
    
    $smarty->display('templates/test_passing.tpl');
  }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
