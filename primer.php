<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'lib/CheckOS.php';
include_once 'lib/PhpLDAP.php';
include_once 'lib/ConfigFile.php';
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
include_once 'DAO/TestingDAO.php';

/* try{ 
    $array=  ConfigFile::getInstance();
    echo "<pre>";
    var_dump ($array->array_params["ParamsDike"]["max_time"]);
    echo "</pre>";
 } catch (Exception $ex) {

 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}*/
$mauth = new MAuthorization();
$auth = new AuthorizationDAO();
$auth->getRoleLDAP($mauth);
 
?>
                    	</body>
</html>
