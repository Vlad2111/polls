<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php

include_once 'lib/CheckOS.php';
include_once 'lib/PhpLDAP.php';
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
include_once 'view/QuizView.php';
include_once 'model/MAnswerUser.php';

 try{ 
     echo "<pre>";
//     $auth=new AuthorizationDAO();
//     $mauth=new MAuthorization();
////     $mauth->setLogin('Иван');
////     $mauth->setPassword(1);
//     $mauth->setLogin('porandaykin.a');
//     $mauth->setPassword('Tecom1');
//     $a=$auth->getObjUser($mauth, 'LDAP');
//     var_dump($a);
//     $ldap=new PhpLDAP();
//     $ldap->checkGroupUser("CN=VPNusers,OU=MainOffice,DC=tecom,DC=nnov,DC=ru", 'Aleksey', 'Porandaykin');
//     var_dump($ldap->getListGroupUsers('CN=Aleksey Porandaykin,OU=RnD,OU=MainOffice,DC=tecom,DC=nnov,DC=ru'));
//     var_dump($ldap->get("OU=MainOffice,DC=tecom,DC=nnov,DC=ru"));
//     var_dump($ldap->checkUser($mauth));
     
//        $mquiz=new MQuiz();
//        $mquiz->setIdQuiz(1);
//        $quiz=new QuizDAO();
//        $array_question=$quiz->getArrayIdQuestion(1);
//        shuffle($array_question);
//        var_dump($array_question);
////  
//     $minterviewee=new MInterviewee();
//     $manswer_user=new MAnswerUser();
//     $manswer_user->setAnswerUser('ds');
//     $manswer_user->setIdQuestion(1);
//     $manswer_user->setIdTesting(1);
//     $interviewee=new IntervieweeDAO();
//     $minterviewee=$interviewee->getDataOneTesting(1);   
//     $array_question=$minterviewee->getQuestion();
////     shuffle($array_question);
//        var_dump($array_question);
//     
//     var_dump($minterviewee);
//        var_dump($minterviewee->getQuestion());
     
     $quiz_view=new QuizView(1);
//     $quiz_view->endQuiz();
     var_dump($quiz_view->getTesting());
//     echo date("Y-m-d H:i:s");
     
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
//     $question=new QuestionDAO();
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
//// }
//     $mauth=new MAuthorization();
//     $mauth->setLogin("porandaykin.a");
//     $mauth->setPasswordLDAP("Tecom1");
//     $auth_ldap=new PhpLDAP();     
//     var_dump($auth_ldap->checkUser($mauth));
//     var_dump($auth_ldap->getListGroupUsers("OU=RnD,OU=MainOffice,DC=tecom,DC=nnov,DC=ru"));
//     var_dump($auth_ldap->checkGroupUser("OU=RnD,OU=MainOffice,DC=tecom,DC=nnov,DC=ru", "Aleksey", "Porandaykin"));
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