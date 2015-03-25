<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php

include_once 'lib/CheckOS.php';
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/UserDAO.php';
include_once 'model/MUser.php';
include_once 'DAO/QuestionDAO.php';
include_once 'model/MQuestion.php';
include_once 'model/MAnswerOptions.php';
include_once 'DAO/AnswerOptionsDAO.php';
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MQuestion.php';

 try{ 
     echo "<pre>";
//        $mquiz=new MQuiz();
//        $mquiz->setIdQuiz(1);
//        $quiz=new QuizDAO();
//        var_dump($quiz->getObjTestQuestion(1));
//        
     $interviewee=new IntervieweeDAO();
     $temp=$interviewee->getDataTesting(1);
     $e=$temp[0];
     var_dump($e->getTest()->getTimeLimit());
     
//     $manswer= new MAnswerOptions();
//     $manswer->setAnswerTheQuestions('Y');
//     $manswer->setRightAnswer('Y');
//     $manswer->setIdAnswerOption(2);
//     $manswer->setIdQuestion(2);
//     
//     $answer_question=new AnswerOptionsDAO();
//     var_dump($answer_question->deleteAnswerQuestion($manswer));
//     
//     $mquestion=new MQuestion();
//     $mquestion->setTextQuestion('Это тест');
//     $mquestion->setIdQuestionsType(1);
//     $mquestion->setCommentQuestion('TEST');
//     $mquestion->setIdTest(1);
//     $mquestion->setQuestionNumber(1);
//     $mquestion->setIdQuestion(2);
//     
     $question=new QuestionDAO();
//     var_dump($question->getListAnswerOptions(2));
//     var_dump($question->updateQuestion($mquestion));
     
//     
//     $muser=new MUser();
//     $muser->setLastName("last_name_test");
//     $muser->setEmail("email_test");
//     $muser->setFirstName("first_name_test");
//     $muser->setIdRole(1);
//     $muser->setLogin("test");
//     $muser->setPassword("test");
//     echo "<pre>";
//     var_dump($muser);
//     echo "<hr>";
//     $user=new UserDAO();
////     $user->createUser($muser);     
//     $user->setIdUser($muser);
////     $user->updateUser($muser);
////     $user->addRole($muser);
////     $user->resetPassword($muser, "test_new");
//     $user->deleteRole($muser);
//     $user->deleteUser($muser);
//     var_dump($muser);
//     echo "</pre>";
     
     
     
//$administration=new AdministrationDAO();
//     echo "<pre>";
////       var_dump($administration->getListIdQuiz());
////       var_dump($administration->getListIdUsers());
////     var_dump($administration->getDataUsers());
////     var_dump($administration->getObjDataQuiz(6));
//     var_dump($administration->getObjDataUser(8));
//
//     echo "</pre>";
// }
//    echo "<pre>"; 
//     $mauth=new MAuthorization();
//     $mauth->setLogin('Иван');
//     $mauth->setPassword(1);
//     $auth=new AuthorizationDAO();
//     var_dump($auth->getUser($mauth));
     echo "</pre>";
 } catch (Exception $ex) {

 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}

 
?>
                    	</body>
</html>