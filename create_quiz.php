<?php
session_start();
 try{ 
     include_once 'view/checkOnPage.php';
include_once 'view/CreateQuizView.php';     
include_once 'lib/smarty_lib/Smarty.class.php';

$create_quiz=new CreateQuizView($_SESSION['id_user']);



$mauthor= new MAuthorQuiz();
$mauthor->setIdUser($_SESSION['id_user']);
$author= new AuthorQuizDAO();

$forms="new_quiz";

if ($_SESSION['new_id_quiz']==NULL && $_SESSION['new_id_quiz']==""){        
            $topic_quiz=filter_input(INPUT_POST, 'topic_quiz', FILTER_SANITIZE_SPECIAL_CHARS);
            if (isset($topic_quiz)){
            $time_limit=filter_input(INPUT_POST, 'time_limit', FILTER_SANITIZE_SPECIAL_CHARS);
            $set_time_limit=filter_input(INPUT_POST, 'set_time_limit', FILTER_SANITIZE_SPECIAL_CHARS);
            $comment_test=filter_input(INPUT_POST, 'comment_test', FILTER_SANITIZE_SPECIAL_CHARS);
            $see_the_result=filter_input(INPUT_POST, 'see_the_result', FILTER_SANITIZE_SPECIAL_CHARS);
            $see_details=filter_input(INPUT_POST, 'see_details', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_test=filter_input(INPUT_POST, 'status_test', FILTER_SANITIZE_SPECIAL_CHARS);
            
            
            $_SESSION['new_id_quiz']=$create_quiz->createQuiz($topic_quiz, $time_limit, $set_time_limit, $comment_test, $see_the_result, $see_details, $status_test);
            $forms='add_question';
            }
          
}
elseif(filter_input(INPUT_POST, 'button_create_quiz', FILTER_SANITIZE_SPECIAL_CHARS)=="new_question") {
    $forms="new_question";
}

if(filter_input(INPUT_POST, 'add_question', FILTER_SANITIZE_SPECIAL_CHARS)=='yes'){
    
        $text_question=filter_input(INPUT_POST, 'text_question', FILTER_SANITIZE_SPECIAL_CHARS);
        $comment_question=filter_input(INPUT_POST, 'comment_question', FILTER_SANITIZE_SPECIAL_CHARS);
        $question_type=filter_input(INPUT_POST, 'question_type', FILTER_SANITIZE_SPECIAL_CHARS);
        $new_id_quiz=$_SESSION['new_id_quiz'];
        $create_quiz->addQuestion($text_question, $comment_question, $question_type, $new_id_quiz);
        
        if ($question_type==1){            
            $forms='add_answer_option';
        }
        elseif($question_type==2){
            $forms='add_answer_option';
        }
        elseif($question_type==3){
            $forms='add_answer_option';
        }
        elseif($question_type==4){
            $forms='add_question';
    }  
}
if(isset($_SESSION['new_id_quiz'])){
    $data_question=$author->getDataQuestion($_SESSION['new_id_quiz']);
}

$title="Меню администратора";
$you=$_SESSION['fio_user'];
    $smarty->assign('title', $title);
    $smarty->assign('name_page', $name_page);    
    $smarty->assign('forms', $forms); 
    $smarty->assign('data_question', $data_question);
    
    $smarty->display('templates/create_quiz.tpl');
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
