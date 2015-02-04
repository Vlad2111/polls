<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'model/ValuesQuiz.php';
include_once 'model/QuizDAO.php';
 try{ 
     $quiz= new ValuesQuiz;
$quiz->comment_question='к';
$quiz->texts='Ваше имя?';
$quiz->type=1;
$quiz->answer='a';
$dao=new QuizDAO();
$dao->createQuestion($quiz);
echo $quiz->id_question;
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>