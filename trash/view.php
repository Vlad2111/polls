<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include_once 'DAO/QuestionDAO.php';
include_once 'model/MQuestions.php';
include_once 'template_smarty/smarty_lib/Smarty.class.php';

if(isset($_REQUEST['text_question']) && isset($_REQUEST['type_question'])){
$question_value= new MQuestions();
$question_value->setTexts($_REQUEST['text_question']);
$question_value->setType($_REQUEST['type_question']);
$question_value->setAnswer($_REQUEST['answer_question']);
$question_value->setCommentQuestion($_REQUEST['coment_question']);
$question=new QuestionDAO();
$result=$question->createQuestion($question_value);
$error="Ошибка";
if($result){$error="";}
}
$smarty= new Smarty();
$title='Добавление вопроса';
$action='view.php';
$address="menu.php";
$smarty->assign('title', $title);
$smarty->assign('action', $action);
$smarty->assign('address', $address);
$smarty->display('template_smarty/templates/view.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>