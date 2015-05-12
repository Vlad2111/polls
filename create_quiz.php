<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'view/CreateQuizView.php';     

$create_quiz_view=new CreateQuizView($_SESSION['id_user']);
//$mauthor= new MAuthorQuiz();
//$mauthor->setIdUser($_SESSION['id_user']);
//$author= new AuthorQuizDAO();
$link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
$button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
if($link_click=='new_quiz'){      
    $view_quiz="new_quiz";
}
elseif($link_click=='edit_quiz'){
    $_SESSION['id_quiz']=filter_input(INPUT_GET, 'id_quiz', FILTER_SANITIZE_SPECIAL_CHARS);
    $view_quiz='edit_quiz';
}
    
if($button_click=='create_quiz'){
    if ($_SESSION['id_quiz']==NULL && $_SESSION['id_quiz']==""){        
            $topic_quiz=filter_input(INPUT_POST, 'topic_quiz', FILTER_SANITIZE_SPECIAL_CHARS);
            if (isset($topic_quiz)){
            $time_limit=filter_input(INPUT_POST, 'time_limit', FILTER_SANITIZE_SPECIAL_CHARS);
            $set_time_limit=filter_input(INPUT_POST, 'set_time_limit', FILTER_SANITIZE_SPECIAL_CHARS);
            $comment_test=filter_input(INPUT_POST, 'comment_test', FILTER_SANITIZE_SPECIAL_CHARS);
            $see_the_result=filter_input(INPUT_POST, 'see_the_result', FILTER_SANITIZE_SPECIAL_CHARS);
            $see_details=filter_input(INPUT_POST, 'see_details', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_test=filter_input(INPUT_POST, 'status_test', FILTER_SANITIZE_SPECIAL_CHARS);
            $_SESSION['id_quiz']=$create_quiz_view->createQuiz($topic_quiz, $time_limit, $set_time_limit, $comment_test, $see_the_result, $see_details, $status_test);
            $view_quiz='add_question';
            }          
    }
}
elseif($button_click=="new_question") {
    $view_quiz="new_question";
}

elseif($button_click=='add_question'){    
        $text_question=filter_input(INPUT_POST, 'text_question', FILTER_SANITIZE_SPECIAL_CHARS);
        $comment_question=filter_input(INPUT_POST, 'comment_question', FILTER_SANITIZE_SPECIAL_CHARS);
        $question_type=filter_input(INPUT_POST, 'question_type', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_quiz=$_SESSION['id_quiz'];
        $_SESSION['id_question']= $create_quiz_view->addQuestion($text_question, $comment_question, $question_type, $id_quiz);
        if ($question_type==1){            
            $add_answer_type_yorn=filter_input(INPUT_POST, 'add_answer_type_yorn', FILTER_SANITIZE_SPECIAL_CHARS);
            $temp=$create_quiz_view->addAnswerQuestion($_SESSION['id_question'], $add_answer_type_yorn);
        }
        elseif($question_type==2){
            $view_quiz='add_answer_option_one';
        }
        elseif($question_type==3){
            $view_quiz='add_answer_option_more';
        }
        elseif($question_type==4){
            $view_quiz='add_question';
    }  
}
//echo $_SESSION['id_quiz'];
if(isset($_SESSION['id_quiz'])){
    $data_questions=$create_quiz_view->getDataQuestion($_SESSION['id_quiz']);
}
//echo $_SESSION['id_question'];
$title="Меню администратора";
$you=$_SESSION['fio_user'];
    $smarty->assign('title', $title);
    $smarty->assign('name_page', $name_page);    
    $smarty->assign('view_quiz', $view_quiz); 
    $smarty->assign('data_question', $data_questions);
    
    $smarty->display('templates/create_quiz.tpl');
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
